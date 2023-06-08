<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a ceiling fan with different speed settings.
 */
class CeilingFan
{
    private string $locationId;
    private Speed $speed;

    /**
     * CeilingFan constructor.
     *
     * @param string $locationId The identifier/location of the ceiling fan.
     */
    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
        $this->speed = Speed::OFF;
    }

    /**
     * Turns off the ceiling fan.
     */
    public function off(): void
    {
        $this->speed = Speed::OFF;
        echo sprintf("<div class=\"action\">Ceiling Fan at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the ceiling fan to low speed.
     */
    public function low(): void
    {
        $this->speed = Speed::LOW;
        echo sprintf("<div class=\"action\">Ceiling Fan at %s was set to low speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the ceiling fan to medium speed.
     */
    public function medium(): void
    {
        $this->speed = Speed::MEDIUM;
        echo sprintf("<div class=\"action\">Ceiling Fan at %s was set to medium speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the ceiling fan to high speed.
     */
    public function high(): void
    {
        $this->speed = Speed::HIGH;
        echo sprintf("<div class=\"action\">Ceiling Fan at %s was set to high speed</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Gets the current speed of the ceiling fan.
     *
     * @return Speed The current speed of the ceiling fan.
     */
    public function getSpeed(): Speed
    {
        return $this->speed;
    }
}