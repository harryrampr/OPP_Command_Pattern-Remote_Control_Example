<?php
declare(strict_types=1);

namespace Tests\docker_containers;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class EnvironmentVariablesTest
 *
 * Test case to verify the existence and valid value of important environment variables and arguments.
 */
class EnvironmentVariablesAndArgsTest extends TestCase
{

    /**
     * Test if SERVER_DEVMENT_DIR environment variable is set correctly,
     * also verifies that ARG SERVER_DEVMENT_DIR is set and has the same value.
     *
     * @return void
     */
    public function testServerDevmentDirEnvVarS(): void
    {
        // If this value is changed, ARG SERVER_DEVMENT_DIR at file www.Dockerfile must change too
        $expectedValue = '/var/www/dev';
        $varValue = $_ENV['SERVER_DEVMENT_DIR'];

        $this->assertEquals($expectedValue, $varValue);
        // .env file must contain SERVER_DEVMENT_DIR variable
        $this->assertStringContainsString('SERVER_DEVMENT_DIR=' . $expectedValue, $this->dotEnvFileContent);
        // www.Dockerfile file must contain SERVER_DEVMENT_DIR variable
        $this->assertStringContainsString('ARG SERVER_DEVMENT_DIR=' . $expectedValue, $this->dockerfileContent);
    }

    /**
     * Test if DB_CONTAINER_NAME environment variable is set correctly,
     * also verifies that ARG DATABASE_HOST is set and has the same value.
     *
     * @return void
     */
    public function testDbHostNameEnvVarS(): void
    {
        $varValue = $_ENV['DB_CONTAINER_NAME'];

        // Value must equal to 'db', don't change this value
        $this->assertEquals('db', $varValue);
        // .env file must contain DB_CONTAINER_NAME variable
        $this->assertStringContainsString('DB_CONTAINER_NAME=' . $varValue, $this->dotEnvFileContent);
        // Value of ARG DATABASE_HOST must be the same of DB_CONTAINER_NAME
        $this->assertStringContainsString('ARG DATABASE_HOST=' . $varValue, $this->dockerfileContent);
    }

    /**
     * Test if DB_CONTAINER_HOST_PORT environment variable is set at .env file
     *
     * @return void
     */
    public function testDbContainerHostPortEnvVarS(): void
    {
        $varValue = $_ENV['DB_CONTAINER_HOST_PORT'];

        // Value must be set
        $this->assertNotNull($varValue);
        // .env file must contain DB_CONTAINER_HOST_PORT variable
        $this->assertStringContainsString('DB_CONTAINER_HOST_PORT=' . $varValue, $this->dotEnvFileContent);
    }

    /**
     * Test if DB_CONTAINER_VOLUME_NAME environment variable is set at .env file
     *
     * @return void
     */
    public function testDbContainerVolumeNameEnvVarS(): void
    {
        $varValue = $_ENV['DB_CONTAINER_VOLUME_NAME'];

        // Value must be set
        $this->assertNotNull($varValue);
        // .env file must contain DB_CONTAINER_VOLUME_NAME variable
        $this->assertStringContainsString('DB_CONTAINER_VOLUME_NAME=' . $varValue, $this->dotEnvFileContent);
    }

    /**
     * Test if DB_CONTAINER_VOLUME_EXTERNAL environment variable is set at .env file
     *
     * @return void
     */
    public function testDbContainerVolumeExternalEnvVarS(): void
    {
        $varValue = $_ENV['DB_CONTAINER_VOLUME_EXTERNAL'];
        $validValues = ['y', 'n', 'yes', 'no', 'true', 'false', 'on', 'off'];

        // Value must be valid
        $this->assertContains($varValue, $validValues);
        // .env file must contain DB_CONTAINER_VOLUME_EXTERNAL variable
        $this->assertStringContainsString('DB_CONTAINER_VOLUME_EXTERNAL=' . $varValue, $this->dotEnvFileContent);
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        // Load .env file variables.
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();

        // Store the file contents in properties for access in the test methods
        $this->dotEnvFileContent = file_get_contents(__DIR__ . '/../../../.env');
        $this->appDotEnvFileContent = file_get_contents(__DIR__ . '/../../../app.env');
        $this->dockerfileContent = file_get_contents(__DIR__ . '/../../../www.Dockerfile');
    }
}