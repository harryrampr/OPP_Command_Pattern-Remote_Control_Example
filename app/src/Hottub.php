<?php
declare(strict_types=1);

namespace App;

class Hottub
{
    private string $locationId;
    private Speed $speed;

    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
        $this->speed = Speed::OFF;
    }

    public function off(): void
    {
        $this->speed = Speed::OFF;
        echo sprintf("<div class=\"action\">Hot-tub at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function low(): void
    {
        $this->speed = Speed::LOW;
        echo sprintf("<div class=\"action\">Hot-tub at %s was set to low speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function medium(): void
    {
        $this->speed = Speed::MEDIUM;
        echo sprintf("<div class=\"action\">Hot-tub at %s was set to medium speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function high(): void
    {
        $this->speed = Speed::HIGH;
        echo sprintf("<div class=\"action\">Hot-tub at %s was set to high speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function getSpeed(): Speed
    {
        return $this->speed;
    }
}