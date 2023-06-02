<?php
declare(strict_types=1);

namespace App;

class Functions
{
    private function __construct()
    {
        // Keep private so can't instantiate
    }

    static public function standardThreeSpeedsCommands(object $object, Speed $speed): void
    {
        match ($speed) {
            Speed::HIGH => $object->high(),
            Speed::MEDIUM => $object->medium(),
            Speed::LOW => $object->low(),
            default => $object->off()
        };
    }
}