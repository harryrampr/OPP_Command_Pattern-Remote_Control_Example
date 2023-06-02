<?php
declare(strict_types=1);

namespace App;

class Light
{
    public string $locationId;

    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    public function on(): void
    {
        echo sprintf("<div class=\"action\">Light at %s turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function off(): void
    {
        echo sprintf("<div class=\"action\">Light at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

}