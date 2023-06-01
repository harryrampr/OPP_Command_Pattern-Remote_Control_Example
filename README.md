## Project Templates for PHP Development

### When coding with PHP, it's important to have a good IDE and project templates with the tools you use all the time.

[PhpStorm](https://www.jetbrains.com/phpstorm/) is the best IDE I have ever used. Worth every penny since it helps to
improve your coding quality, saving a lot
of time during development, testing and maintenance. If you aren't using PhpStorm, we encourage you to test it [free for
30 days](https://www.jetbrains.com/phpstorm/download/#section=windows).

We have curated a project template for PHP 8.1.x development. You don't need PhpStorm to use our template, just remove
the`.idea`folder containing PhpStorm configuration.

#### Template Features:

- PhpStorm initial project setup
- Project's basic file structure
- Composer Package Manager (latest)
- File autoload (using composer)
- Xdebug 3.x
- phpUnit 9.x
- MySQL (latest)
- [Docker Containers](https://www.docker.com/products/docker-desktop/) LAMP for code testing
- Support for initial database dump
- Persistent data on database container
- Support for Unit Testing with Coverage Report
- Support for NPM Package Manager
- Tailwind 3 CSS

#### Installation:

1. Download or clone template from repository. To remove git's history from the template, run from Terminal or
   Git Bash the following commands:
   - `rm -rf .git`
   - `git init`
   - `cp sample.env .env`
   - `cp sample.app.env app.env`
   - `git add -A`
   - `git commit -m "Initial commit"`

2. Open project with PhpStorm and go to Settings->PHP, select the`Default PHP Interpreter`. Also, setup`Composer`execs
   location.

3. Update necessary info at`composer.json`file, then run`composer install`.

4. To configure the Docker LAMP, just update `Environmental Variables` values at following files:

    1. For`.env`file, most defaults should work. If necessary replace values of:
        - `SERVER_HTTP_HOST_PORT`
        - `SERVER_HTTPS_HOST_PORT`
        - `DB_CONTAINER_HOST_PORT`
        - `DB_ROOT_PASSWORD`
        - `DB_CONTAINER_VOLUME_NAME`(Must update)
        - `DB_CONTAINER_VOLUME_EXTERNAL`

    2. For`app.env`file, most defaults should work. If necessary replace values of:
        - `DATABASE_HOST`(Must update)
        - `DATABASE_PORT`
        - `DATABASE_USER_NAME`
        - `DATABASE_USER_PASSWORD`
        - `DATABASE_DB_NAME`

   ***Note:** On Windows, use host machine's [WSL](https://learn.microsoft.com/en-us/windows/wsl/about) IP for
   DATABASE_HOST and copy value of DB_CONTAINER_HOST_PORT to DATABASE_PORT. These changes will allow using Docker LAMP
   for
   code testing, also allows using host machine's PHP and PhpStorm Build-in Preview without any configuration problems.*
5. Run `npm install` for the `node_modules` directory to be created at project root.
6. Run all PHPUnit tests located at`app/tests`folder to verify template setup & containers configuration.

7. Add any necessary SQL dumps to the db_dumps folder, they will be imported during the building stage of database
   container.

8. To start the LAMP containers, run these commands at IDE's Terminal:

    - `docker compose build`
    - `docker compose up -d`

9. When necessary, run`docker compose down`to stop the containers.
10. To update Tailwind changes,
    run`npx tailwindcss -i ./app/src/css/tailwind_input.css -o ./app/public/css/main.css --watch`at IDE's Terminal.