<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a Garage Door.
 */
class GarageDoor
{
    private string $locationId;

    /**
     * GarageDoor constructor.
     *
     * @param string $locationId The location identifier of the garage door.
     */
    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * Opens the garage door.
     */
    public function up(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s goes up</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Closes the garage door.
     */
    public function down(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s goes down</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Turns on the light of the garage door.
     */
    public function lightOn(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s light turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Turns off the light of the garage door.
     */
    public function lightOff(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s light turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Stops the movement of the garage door.
     */
    public function stop(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s stops moving</div>%s",
            $this->locationId, PHP_EOL);
    }
}