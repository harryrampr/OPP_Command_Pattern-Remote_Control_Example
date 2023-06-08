<?php
declare(strict_types=1);

namespace App;

/**
 * Concrete command that represents turning the ceiling fan to low speed.
 */
class CeilingFanLowCommand implements Command
{

    private CeilingFan $ceilingFan;
    private Speed $prevSpeed;

    /**
     * CeilingFanLowCommand constructor.
     *
     * @param CeilingFan $ceilingFan The ceiling fan object.
     */
    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    /**
     * Executes the command by setting the ceiling fan to low speed.
     */
    public function execute(): void
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->low();
    }

    /**
     * Undoes the command by setting the ceiling fan back to its previous speed.
     */
    public function undo(): void
    {
        $this->prevSpeed->speedCommand($this->ceilingFan);
    }
}