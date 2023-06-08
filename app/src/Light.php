<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a light.
 */
class Light
{
    /**
     * The ID or location of the light.
     *
     * @var string
     */
    public string $locationId;

    /**
     * Light constructor.
     *
     * @param string $locationId The ID or location of the light.
     */
    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * Turns on the light.
     */
    public function on(): void
    {
        echo sprintf("<div class=\"action\">Light at %s turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Turns off the light.
     */
    public function off(): void
    {
        echo sprintf("<div class=\"action\">Light at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }
}