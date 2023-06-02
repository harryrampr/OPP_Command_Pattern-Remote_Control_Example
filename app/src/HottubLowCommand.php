<?php
declare(strict_types=1);

namespace App;

class HottubLowCommand implements Command
{

    private Hottub $hottub;
    private Speed $prevSpeed;

    public function __construct(Hottub $hottub)
    {
        $this->hottub = $hottub;
    }

    public function execute(): void
    {
        $this->prevSpeed = $this->hottub->getSpeed();
        $this->hottub->low();
    }

    public function undo(): void
    {
        Functions::standardThreeSpeedsCommands($this->hottub, $this->prevSpeed);
    }
}