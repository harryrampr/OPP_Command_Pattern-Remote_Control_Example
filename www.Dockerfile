ARG START_IMAGE_NAME=php
ARG START_IMAGE_TAG='8.1.18-apache-buster'

# Load image with Linux, Apache and PHP
FROM ${START_IMAGE_NAME}:${START_IMAGE_TAG}

# Set basic parameters
ARG SERVER_DEVMENT_DIR=/var/www/dev
ARG SERVER_PUBLIC_DIR=/var/www/dev/app/public
ARG SERVER_PHP_INI_DIR=/usr/local/etc/php
ARG SERVER_DEVMENT_USER=devment
ARG DATABASE_HOST=db
ARG DATABASE_PORT=3306

# Install important libraries
RUN apt-get update && apt-get upgrade -y && \
    docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli

# Install php xdebug
RUN pecl -q install xdebug

# Set php.ini development values
COPY ./custom-php.ini ${SERVER_PHP_INI_DIR}/conf.d
RUN cp /usr/local/etc/php/php.ini-development ${SERVER_PHP_INI_DIR}/php.ini

# Get php 8.1.18 repository
RUN apt-get install -y lsb-release ca-certificates apt-transport-https software-properties-common gnupg2 && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list && \
    curl -fsSL  https://packages.sury.org/php/apt.gpg| gpg --dearmor -o /etc/apt/trusted.gpg.d/sury-keyring.gpg &&\
    apt-get update && apt-get upgrade -y

# Download and install latest Composer
RUN apt-get install -y curl git unzip && \
    curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php && \
    HASH=`curl -sS https://composer.github.io/installer.sig` && \
    php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { exit(0); } \
    else \
    { echo 'Error: Corrupted Composer Download', PHP_EOL; unlink('composer-setup.php'); \
    exit(1); }" && \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Add and set a development user
RUN adduser --no-create-home ${SERVER_DEVMENT_USER}

# Set Apache document root
RUN mkdir -p ${SERVER_PUBLIC_DIR} && \
    chown -R ${SERVER_DEVMENT_USER}:${SERVER_DEVMENT_USER} ${SERVER_DEVMENT_DIR} && \
    chmod -R 1775 ${SERVER_DEVMENT_DIR} && \
    chown -R www-data:www-data ${SERVER_PUBLIC_DIR} && \
    chmod -R 1777 ${SERVER_PUBLIC_DIR} && \
    sed -i "s+DocumentRoot /var/www/html+DocumentRoot ${SERVER_PUBLIC_DIR}+g" /etc/apache2/sites-enabled/000-default.conf
WORKDIR ${SERVER_DEVMENT_DIR}

# Copy development files
COPY --chown=devment:devment --chmod=0775 ./app ${SERVER_DEVMENT_DIR}/app
COPY --chown=devment:devment --chmod=0775 ./composer.json .
COPY --chown=devment:devment --chmod=0775 app.env .

# Update enviroment files on container
RUN php -r "require_once '${SERVER_DEVMENT_DIR}/app/src/EnvWriter.php'; \
    (new App\EnvWriter('${SERVER_DEVMENT_DIR}/app.env'))->writeEnvVariable('DATABASE_HOST', '${DATABASE_HOST}'); \
    exit(0);"
RUN php -r "require_once '${SERVER_DEVMENT_DIR}/app/src/EnvWriter.php'; \
    (new App\EnvWriter('${SERVER_DEVMENT_DIR}/app.env'))->writeEnvVariable('DATABASE_PORT', '${DATABASE_PORT}'); \
    exit(0);"

# Run Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --quiet