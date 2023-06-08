<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to open a garage door.
 */
class GarageDoorOpenCommand implements Command
{
    private GarageDoor $garageDoor;

    /**
     * GarageDoorOpenCommand constructor.
     *
     * @param GarageDoor $garageDoor The garage door to be opened.
     */
    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    /**
     * Executes the command by opening the garage door.
     */
    public function execute(): void
    {
        $this->garageDoor->up();
    }

    /**
     * Undoes the command by closing the garage door.
     */
    public function undo(): void
    {
        $this->garageDoor->down();
    }
}