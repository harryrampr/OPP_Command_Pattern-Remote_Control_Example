<?php declare(strict_types=1);
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Helpers;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../', 'app.env');
$dotenv->safeLoad();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/main.css" rel="stylesheet">
</head>
<body>
<div class="container m-6">
    <?php echo '<h1 class="text-red-600">Hello World!</h1>';
    Helpers::showText("test text...", 'text-lg text-green-600');
    echo "<h3>{$_ENV['DATABASE_PORT']}</h3>"; ?>
</div>
</body>
</html>