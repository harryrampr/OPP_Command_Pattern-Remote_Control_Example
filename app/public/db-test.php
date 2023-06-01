<?php declare(strict_types=1);
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../', 'app.env');
$dotenv->safeLoad();

$mysqli = new mysqli(
    $_ENV['DATABASE_HOST'],
    $_ENV['DATABASE_USER_NAME'],
    $_ENV['DATABASE_USER_PASSWORD'],
    $_ENV['DATABASE_DB_NAME'],
    (int)$_ENV['DATABASE_PORT']
);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Perform query
if ($result = $mysqli->query("SELECT * FROM test_table")) {
    echo "Returned rows are: " . $result->num_rows;
    // Free result set
    $result->free_result();
}

$mysqli->close();