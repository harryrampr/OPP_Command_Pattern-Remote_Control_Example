<?php
declare(strict_types=1);

namespace App;

class GarageDoor
{
    private string $locationId;

    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    public function up(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s goes up</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function down(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s goes down</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function lightOn(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s light turns on</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function lightOff(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s light turns off</div>%s",
            $this->locationId, PHP_EOL);
    }

    public function stop(): void
    {
        echo sprintf("<div class=\"action\">Garage Door at %s stops moving</div>%s",
            $this->locationId, PHP_EOL);
    }
}