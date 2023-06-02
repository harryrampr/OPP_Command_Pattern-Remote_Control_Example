<?php
declare(strict_types=1);

namespace App;

class CeilingFanLowCommand implements Command
{

    private CeilingFan $ceilingFan;
    private Speed $prevSpeed;

    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    public function execute(): void
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->low();
    }

    public function undo(): void
    {
        Functions::standardThreeSpeedsCommands($this->ceilingFan, $this->prevSpeed);
    }
}