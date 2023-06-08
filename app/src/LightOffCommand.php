<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to turn off a light.
 */
class LightOffCommand implements Command
{
    /**
     * The light to control.
     *
     * @var Light
     */
    private Light $light;

    /**
     * LightOffCommand constructor.
     *
     * @param Light $light The light to control.
     */
    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    /**
     * Executes the command by turning off the light.
     */
    public function execute(): void
    {
        $this->light->off();
    }

    /**
     * Undoes the command by turning on the light.
     */
    public function undo(): void
    {
        $this->light->on();
    }
}