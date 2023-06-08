<?php
declare(strict_types=1);

namespace App;

/**
 * Concrete command that represents turning the ceiling fan off.
 */
class CeilingFanOffCommand implements Command
{

    private CeilingFan $ceilingFan;
    private Speed $prevSpeed;

    /**
     * CeilingFanOffCommand constructor.
     *
     * @param CeilingFan $ceilingFan The ceiling fan object.
     */
    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    /**
     * Executes the command by turning the ceiling fan off.
     */
    public function execute(): void
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->off();
    }

    /**
     * Undoes the command by setting the ceiling fan back to its previous speed.
     */
    public function undo(): void
    {
        $this->prevSpeed->speedCommand($this->ceilingFan);
    }
}