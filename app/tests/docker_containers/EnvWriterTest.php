<?php declare(strict_types=1);

namespace Tests\docker_containers;

use App\EnvWriter;
use PHPUnit\Framework\TestCase;

/**
 * Class EnvWriterTest
 *
 * Unit tests for the EnvWriter class.
 */
class EnvWriterTest extends TestCase
{
    /** @var string The path to the test .env file. */
    private string $envFile;

    /** @var EnvWriter The instance of the EnvWriter class. */
    private EnvWriter $envWriter;

    /**
     * Test writing environment variable to the .env file.
     */
    public function testWriteEnvVariable(): void
    {
        // Test writing a new key-value pair to an empty file
        $this->envWriter->writeEnvVariable('KEY', 'VALUE');
        $this->assertFileExists($this->envFile);
        $this->assertStringEqualsFile($this->envFile, "KEY=VALUE");

        // Test modifying an existing key-value pair
        $this->envWriter->writeEnvVariable('KEY', 'NEW_VALUE');
        $this->assertFileExists($this->envFile);
        $this->assertStringEqualsFile($this->envFile, "KEY=NEW_VALUE");

        // Test writing a new key-value pair to an existing file
        $this->envWriter->writeEnvVariable('ANOTHER_KEY', 'ANOTHER_VALUE');
        $this->assertFileExists($this->envFile);
        $this->assertStringEqualsFile($this->envFile, "KEY=NEW_VALUE\nANOTHER_KEY=ANOTHER_VALUE");

        // Test writing a key-value pair with leading/trailing white space
        $this->envWriter->writeEnvVariable('  TRIM_KEY  ', '  TRIM_VALUE  ');
        $this->assertFileExists($this->envFile);
        $this->assertStringEqualsFile($this->envFile, "KEY=NEW_VALUE\nANOTHER_KEY=ANOTHER_VALUE\nTRIM_KEY=TRIM_VALUE");

        // Test writing a key-value pair with special characters
        $this->envWriter->writeEnvVariable('SPECIAL_KEY', 'Some "value" with \'special\' characters');
        $this->assertFileExists($this->envFile);
        $this->assertStringEqualsFile($this->envFile, "KEY=NEW_VALUE\nANOTHER_KEY=ANOTHER_VALUE\nTRIM_KEY=TRIM_VALUE\nSPECIAL_KEY=Some \"value\" with 'special' characters");
    }

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        $this->envFile = __DIR__ . '/test.env';
        // Ensure the test.env file doesn't exist initially
        if (file_exists($this->envFile)) {
            unlink($this->envFile);
        }
        $this->envWriter = new EnvWriter($this->envFile);
    }

    /**
     * Clean up the test environment.
     */
    protected function tearDown(): void
    {
        // Clean up the test.env file after each test
        if (file_exists($this->envFile)) {
            unlink($this->envFile);
        }
    }
}