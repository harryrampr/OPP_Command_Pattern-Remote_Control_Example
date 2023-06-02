<?php
declare(strict_types=1);

namespace App;

class GarageDoorCloseCommand implements Command
{
    private GarageDoor $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    public function execute(): void
    {
        $this->garageDoor->down();
    }

    public function undo(): void
    {
        $this->garageDoor->up();
    }
}