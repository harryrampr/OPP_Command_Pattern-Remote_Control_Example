<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a command to turn on the stereo with CD.
 */
class StereoOnWithCDCommand implements Command
{
    /**
     * The stereo object associated with the command.
     *
     * @var Stereo
     */
    private Stereo $stereo;

    /**
     * StereoOnWithCDCommand constructor.
     *
     * @param Stereo $stereo The stereo object to control.
     */
    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    /**
     * Executes the command by turning on the stereo, selecting CD, and setting the volume.
     */
    public function execute(): void
    {
        $this->stereo->on();
        $this->stereo->setCd();
        $this->stereo->setVolume(11);
    }

    /**
     * Reverses the command by turning off the stereo.
     */
    public function undo(): void
    {
        $this->stereo->off();
    }
}