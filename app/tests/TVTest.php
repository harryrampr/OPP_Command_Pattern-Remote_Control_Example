<?php

namespace Tests;

use App\TV;
use PHPUnit\Framework\TestCase;

class TVTest extends TestCase
{
    public function testOn(): void
    {
        $locationId = 'living_room';
        $tv = new TV($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">TV at $locationId turns on</div>" . PHP_EOL);

        $tv->on();
    }

    public function testOff(): void
    {
        $locationId = 'living_room';
        $tv = new TV($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">TV at $locationId turns off</div>" . PHP_EOL);

        $tv->off();
    }

    public function testSetChannel(): void
    {
        $locationId = 'living_room';
        $tv = new TV($locationId);
        $channel = 10;

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">TV at $locationId channel was set to channel $channel</div>" . PHP_EOL);

        $tv->setChannel($channel);
    }

    public function testSetVolume(): void
    {
        $locationId = 'living_room';
        $tv = new TV($locationId);
        $volumeLevel = 5;

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">TV at $locationId volume was set to level $volumeLevel</div>" . PHP_EOL);

        $tv->setVolume($volumeLevel);
    }
}