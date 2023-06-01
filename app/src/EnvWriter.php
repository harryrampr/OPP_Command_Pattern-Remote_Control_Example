<?php declare(strict_types=1);

namespace App;

/**
 * Class EnvWriter
 *
 * The EnvWriter class is responsible for writing environment variables to a .env file.
 */
class EnvWriter
{
    /**
     * @var string The path to the .env file.
     */
    private string $envFile;

    /**
     * EnvWriter constructor.
     *
     * @param string $envFile The path to the .env file. Default is __DIR__ . '/../../.env'.
     */
    public function __construct(string $envFile = __DIR__ . '/../../.env')
    {
        $this->envFile = $envFile;
    }

    /**
     * Writes an environment variable to the .env file.
     *
     * @param string $key  The name of the environment variable.
     * @param mixed $value The value of the environment variable.
     *
     * @return void
     */
    public function writeEnvVariable(string $key, mixed $value): void
    {
        // Check if the file exists
        if (file_exists($this->envFile)) {
            $envContent = file_get_contents($this->envFile);

            // Remove white space around equal sign in existing key-value pairs
            $envContent = preg_replace('/\s*=\s*/', '=', $envContent);

            // Replace Windows-style line endings with Unix-style line endings
            $envContent = preg_replace('/\r\n/', "\n", $envContent);

            // Sanitize input
            $key = trim($key);
            $value = trim($value);

            $searchPattern = "/^{$key}=.*/m";

            if (preg_match($searchPattern, $envContent)) {
                // If the key already exists, replace its value
                $envContent = preg_replace($searchPattern, "{$key}={$value}", $envContent);
            } else {
                // If the key doesn't exist, append it to the end of the file
                $envContent .= "\n{$key}={$value}";
            }
        } else {
            // If the file doesn't exist, create the new content
            $envContent = "{$key}={$value}";
        }
        // Write content to file
        file_put_contents($this->envFile, $envContent, LOCK_EX);
    }
}