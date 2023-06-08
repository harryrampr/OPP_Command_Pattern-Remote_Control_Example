<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a TV.
 */
class TV
{
    /**
     * The location identifier of the TV.
     *
     * @var string
     */
    public string $locationId;

    /**
     * TV constructor.
     *
     * @param string $locationId The location identifier of the TV.
     */
    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * Turns on the TV.
     */
    public function on(): void
    {
        echo sprintf("<div class=\"action\">TV at %s turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Turns off the TV.
     */
    public function off(): void
    {
        echo sprintf("<div class=\"action\">TV at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the channel of the TV.
     *
     * @param int $channel The channel number.
     */
    public function setChannel(int $channel): void
    {
        echo sprintf("<div class=\"action\">TV at %s channel was set to channel %d</div>%s",
            $this->locationId, $channel, PHP_EOL);
    }

    /**
     * Sets the volume level of the TV.
     *
     * @param int $level The volume level.
     */
    public function setVolume(int $level): void
    {
        echo sprintf("<div class=\"action\">TV at %s volume was set to level %d</div>%s",
            $this->locationId, $level, PHP_EOL);
    }
}