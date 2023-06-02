<?php
declare(strict_types=1);

namespace App;

class StereoOffCommand implements Command
{

    private Stereo $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute(): void
    {
        $this->stereo->off();
    }

    public function undo(): void
    {
        $this->stereo->on();
    }
}