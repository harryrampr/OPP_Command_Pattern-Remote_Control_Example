<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a Hottub.
 */
class Hottub
{
    private string $locationId;
    private Speed $speed;

    /**
     * Hottub constructor.
     *
     * @param string $locationId The location ID of the Hottub.
     */
    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
        $this->speed = Speed::OFF;
    }

    /**
     * Turns off the Hottub.
     */
    public function off(): void
    {
        $this->speed = Speed::OFF;
        echo sprintf("<div class=\"action\">Hot-tub at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the Hottub to low speed.
     */
    public function low(): void
    {
        $this->speed = Speed::LOW;
        echo sprintf("<div class=\"action\">Hot-tub at %s was set to low speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the Hottub to medium speed.
     */
    public function medium(): void
    {
        $this->speed = Speed::MEDIUM;
        echo sprintf("<div class=\"action\">Hot-tub at %s was set to medium speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the Hottub to high speed.
     */
    public function high(): void
    {
        $this->speed = Speed::HIGH;
        echo sprintf("<div class=\"action\">Hot-tub at %s was set to high speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Gets the current speed of the Hottub.
     *
     * @return Speed The current speed of the Hottub.
     */
    public function getSpeed(): Speed
    {
        return $this->speed;
    }
}