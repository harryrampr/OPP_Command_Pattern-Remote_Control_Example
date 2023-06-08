<?php
declare(strict_types=1);

namespace App;

/**
 * Concrete command that represents turning the ceiling fan to medium speed.
 */
class CeilingFanMediumCommand implements Command
{

    private CeilingFan $ceilingFan;
    private Speed $prevSpeed;

    /**
     * CeilingFanMediumCommand constructor.
     *
     * @param CeilingFan $ceilingFan The ceiling fan object.
     */
    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    /**
     * Executes the command by setting the ceiling fan to medium speed.
     */
    public function execute(): void
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->medium();
    }

    /**
     * Undoes the command by setting the ceiling fan back to its previous speed.
     */
    public function undo(): void
    {
//        Functions::standardThreeSpeedsCommands($this->ceilingFan, $this->prevSpeed);
        $this->prevSpeed->speedCommand($this->ceilingFan);

    }
}