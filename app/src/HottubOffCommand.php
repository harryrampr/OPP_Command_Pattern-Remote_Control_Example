<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to turn off the Hottub.
 */
class HottubOffCommand implements Command
{

    private Hottub $hottub;
    private Speed $prevSpeed;

    /**
     * HottubOffCommand constructor.
     *
     * @param Hottub $hottub The Hottub object associated with the command.
     */
    public function __construct(Hottub $hottub)
    {
        $this->hottub = $hottub;
    }

    /**
     * Executes the command by turning off the Hottub.
     */
    public function execute(): void
    {
        $this->prevSpeed = $this->hottub->getSpeed();
        $this->hottub->off();
    }

    /**
     * Undoes the command by setting the Hottub to the previous speed.
     */
    public function undo(): void
    {
        $this->prevSpeed->speedCommand($this->hottub);
    }
}