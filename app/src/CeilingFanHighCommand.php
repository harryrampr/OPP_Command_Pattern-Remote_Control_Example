<?php
declare(strict_types=1);

namespace App;

/**
 * Concrete command that represents turning the ceiling fan to high speed.
 */
class CeilingFanHighCommand implements Command
{

    private CeilingFan $ceilingFan;
    private Speed $prevSpeed;

    /**
     * CeilingFanHighCommand constructor.
     *
     * @param CeilingFan $ceilingFan The ceiling fan object.
     */
    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    /**
     * Executes the command by setting the ceiling fan to high speed.
     */
    public function execute(): void
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->high();
    }

    /**
     * Undoes the command by setting the ceiling fan back to its previous speed.
     */
    public function undo(): void
    {
        $this->prevSpeed->speedCommand($this->ceilingFan);
    }
}