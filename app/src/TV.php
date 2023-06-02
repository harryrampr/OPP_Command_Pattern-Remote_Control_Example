<?php
declare(strict_types=1);

namespace App;

class TV
{
    public string $locationId;

    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    public function on(): void
    {
        echo sprintf("<div class=\"action\">TV at %s turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function off(): void
    {
        echo sprintf("<div class=\"action\">TV at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function setChannel(int $channel): void
    {
        echo sprintf("<div class=\"action\">TV at %s channel was set to channel %d</div>%s",
            $this->locationId, $channel, PHP_EOL);
    }

    public function setVolume(int $level): void
    {
        echo sprintf("<div class=\"action\">TV at %s volume was set to level %d</div>%s",
            $this->locationId, $level, PHP_EOL);
    }


}