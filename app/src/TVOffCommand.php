<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to turn off a TV.
 */
class TVOffCommand implements Command
{
    /**
     * The TV instance associated with the command.
     *
     * @var TV
     */
    private TV $tv;

    /**
     * TVOffCommand constructor.
     *
     * @param TV $tv The TV instance to control.
     */
    public function __construct(TV $tv)
    {
        $this->tv = $tv;
    }

    /**
     * Executes the command by turning off the TV.
     */
    public function execute(): void
    {
        $this->tv->off();
    }

    /**
     * Reverts the command execution by turning on the TV.
     */
    public function undo(): void
    {
        $this->tv->on();
    }
}