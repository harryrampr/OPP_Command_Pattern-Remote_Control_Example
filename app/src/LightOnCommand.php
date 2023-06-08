<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to turn on a light.
 */
class LightOnCommand implements Command
{
    /**
     * The light to control.
     *
     * @var Light
     */
    private Light $light;

    /**
     * LightOnCommand constructor.
     *
     * @param Light $light The light to control.
     */
    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    /**
     * Executes the command by turning on the light.
     */
    public function execute(): void
    {
        $this->light->on();
    }

    /**
     * Undoes the command by turning off the light.
     */
    public function undo(): void
    {
        $this->light->off();
    }
}