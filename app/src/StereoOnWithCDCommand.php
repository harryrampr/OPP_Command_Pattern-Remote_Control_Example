<?php
declare(strict_types=1);

namespace App;

class StereoOnWithCDCommand implements Command
{
    private Stereo $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute(): void
    {
        $this->stereo->on();
        $this->stereo->setCd();
        $this->stereo->setVolume(11);
    }

    public function undo(): void
    {
        $this->stereo->off();
    }
}