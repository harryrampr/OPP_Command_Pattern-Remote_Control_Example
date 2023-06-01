<?php declare(strict_types=1);

namespace App;

class Helpers
{
    public static function showText(string $text, string $tagClass): void
    {
        echo "<p class=\"$tagClass\">$text</p>";
    }
}