<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to set the Hottub to low speed.
 */
class HottubLowCommand implements Command
{

    private Hottub $hottub;
    private Speed $prevSpeed;

    /**
     * HottubLowCommand constructor.
     *
     * @param Hottub $hottub The Hottub object associated with the command.
     */
    public function __construct(Hottub $hottub)
    {
        $this->hottub = $hottub;
    }

    /**
     * Executes the command by setting the Hottub to low speed.
     */
    public function execute(): void
    {
        $this->prevSpeed = $this->hottub->getSpeed();
        $this->hottub->low();
    }

    /**
     * Undoes the command by setting the Hottub to the previous speed.
     */
    public function undo(): void
    {
        $this->prevSpeed->speedCommand($this->hottub);
    }
}