<?php
declare(strict_types=1);

namespace App;

class StereoOnCommand implements Command
{

    private Stereo $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute(): void
    {
        $this->stereo->on();
    }

    public function undo(): void
    {
        $this->stereo->off();
    }
}