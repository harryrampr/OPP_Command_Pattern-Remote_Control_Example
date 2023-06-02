<?php
declare(strict_types=1);

namespace App;

class Stereo
{
    private string $locationId;

    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    public function on(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function off(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function setCd(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s selected the CD</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function setDvd(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s selected the DVD</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function setVolume(int $level): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s volume was set to level %d</div>%s",
            $this->locationId, $level, PHP_EOL);
    }

}