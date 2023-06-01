<?php
declare(strict_types=1);

namespace Tests\docker_containers;

use PHPUnit\Framework\TestCase;

/**
 * Class TestContainerNeededFilesExist
 *
 * Test case to verify the existence of necessary folders and files to create LAMP containers.
 */
class TestContainerNeededFilesExist extends TestCase
{
    /**
     * Test if the app/public directory exists at the root of the project.
     *
     * @return void
     */
    public function testPublicDirectoryExists(): void
    {
        $filePath = __DIR__ . '/../../../app/public';
        $this->assertDirectoryExists($filePath);
    }

    /**
     * Test if the db_dumps directory exists at the root of the project.
     *
     * @return void
     */
    public function testDbDumpsDirectoryExists(): void
    {
        $filePath = __DIR__ . '/../../../db_dumps';
        $this->assertDirectoryExists($filePath);
    }

    /**
     * Test if the .env file exists at the root of the project.
     *
     * @return void
     */
    public function testDotEnvFileExists(): void
    {
        $filePath = __DIR__ . '/../../../.env';
        $this->assertFileExists($filePath);
    }

    /**
     * Test if the app.env file exists at the root of the project.
     *
     * @return void
     */
    public function testAppDotEnvFileExists(): void
    {
        $filePath = __DIR__ . '/../../../app.env';
        $this->assertFileExists($filePath);
    }

    /**
     * Test if the custom-php.ini file exists at the root of the project.
     *
     * @return void
     */
    public function testCustomPhpIniFileExists(): void
    {
        $filePath = __DIR__ . '/../../../custom-php.ini';
        $this->assertFileExists($filePath);
    }

    /**
     * Test if the docker-compose.yml file exists at the root of the project.
     *
     * @return void
     */
    public function testDockerComposeYmlFileExists(): void
    {
        $filePath = __DIR__ . '/../../../docker-compose.yml';
        $this->assertFileExists($filePath);
    }

    /**
     * Test if the www.Dockerfile exists at the root of the project.
     *
     * @return void
     */
    public function testWwwDockerfileExists(): void
    {
        $filePath = __DIR__ . '/../../../www.Dockerfile';
        $this->assertFileExists($filePath);
    }

}