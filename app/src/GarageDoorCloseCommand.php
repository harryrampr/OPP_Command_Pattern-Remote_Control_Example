<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to close a garage door.
 */
class GarageDoorCloseCommand implements Command
{
    private GarageDoor $garageDoor;

    /**
     * GarageDoorCloseCommand constructor.
     *
     * @param GarageDoor $garageDoor The garage door to be closed.
     */
    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    /**
     * Executes the command by closing the garage door.
     */
    public function execute(): void
    {
        $this->garageDoor->down();
    }

    /**
     * Undoes the command by opening the garage door.
     */
    public function undo(): void
    {
        $this->garageDoor->up();
    }
}