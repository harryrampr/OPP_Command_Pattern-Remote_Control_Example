<?php
declare(strict_types=1);

namespace App;

/**
 * Represents a stereo system.
 */
class Stereo
{
    /**
     * The location identifier of the stereo.
     *
     * @var string
     */
    private string $locationId;

    /**
     * Stereo constructor.
     *
     * @param string $locationId The location identifier of the stereo.
     */
    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * Turns on the stereo.
     */
    public function on(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Turns off the stereo.
     */
    public function off(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Selects the CD mode on the stereo.
     */
    public function setCd(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s selected the CD</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Selects the DVD mode on the stereo.
     */
    public function setDvd(): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s selected the DVD</div>%s",
            $this->locationId, PHP_EOL);
    }

    /**
     * Sets the volume level on the stereo.
     *
     * @param int $level The volume level to set.
     */
    public function setVolume(int $level): void
    {
        echo sprintf("<div class=\"action\">Stereo at %s volume was set to level %d</div>%s",
            $this->locationId, $level, PHP_EOL);
    }
}