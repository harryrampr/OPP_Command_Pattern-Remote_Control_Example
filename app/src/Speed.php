<?php declare(strict_types=1);

namespace App;

/**
 * The Speed enum represents different speed levels.
 */
enum Speed: int
{
    /**
     * High speed level.
     */
    case HIGH = 3;

    /**
     * Medium speed level.
     */
    case MEDIUM = 2;

    /**
     * Low speed level.
     */
    case LOW = 1;

    /**
     * Off speed level.
     */
    case OFF = 0;

    /**
     * Executes the corresponding command on the provided object based on the speed level.
     *
     * @param object $object The object on which the command is executed.
     */
    public function speedCommand(object $object): void
    {
        match ($this) {
            self::HIGH => $object->high(),
            self::MEDIUM => $object->medium(),
            self::LOW => $object->low(),
            self::OFF => $object->off()
        };
    }
}