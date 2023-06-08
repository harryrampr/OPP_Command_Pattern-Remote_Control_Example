<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to turn off the stereo.
 */
class StereoOffCommand implements Command
{
    /**
     * The stereo object associated with the command.
     *
     * @var Stereo
     */
    private Stereo $stereo;

    /**
     * StereoOffCommand constructor.
     *
     * @param Stereo $stereo The stereo object to control.
     */
    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    /**
     * Executes the command by turning off the stereo.
     */
    public function execute(): void
    {
        $this->stereo->off();
    }

    /**
     * Reverses the command by turning on the stereo.
     */
    public function undo(): void
    {
        $this->stereo->on();
    }
}