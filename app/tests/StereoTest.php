<?php

namespace Tests;

use App\Stereo;
use PHPUnit\Framework\TestCase;

/**
 * Class StereoTest
 *
 * Test class for Stereo.
 */
class StereoTest extends TestCase
{
    /**
     * Test properties of Stereo class for access type and value type.
     */
    public function testStereoProperties(): void
    {
        $expectedResults = [
            'locationId' => ['access' => 'private', 'type' => 'string'],
        ];
        $reflectionClass = new \ReflectionClass(Stereo::class);
        $properties = $reflectionClass->getProperties();

        $this->assertSame(count($expectedResults), count($properties));

        foreach ($properties as $property) {
            $propertyName = $property->getName();

            // Test Property Access Type
            match ($expectedResults[$propertyName]['access']) {
                'private' => $this->assertTrue($property->isPrivate()),
                'protected' => $this->assertTrue($property->isProtected()),
                'public' => $this->assertTrue($property->isPublic()),
                default => $this->fail("Unknown access type on property $propertyName.")
            };

            // Test Property Value Type
            $this->assertSame($expectedResults[$propertyName]['type'], $property->getType()->getName());
        }
    }

    /**
     * Test the construction of Stereo.
     */
    public function testConstruction(): void
    {
        $locationId = 'living_room';
        $stereo = new Stereo($locationId);

        $reflectionClass = new \ReflectionClass(Stereo::class);

        // Test constructor argument
        $locationIdProperty = $reflectionClass->getProperty('locationId');
        $locationIdProperty->setAccessible(true);
        $this->assertSame($locationId, $locationIdProperty->getValue($stereo));
    }

    /**
     * Test the on() method of Stereo.
     */
    public function testOn(): void
    {
        $locationId = 'living_room';
        $stereo = new Stereo($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Stereo at $locationId turns on</div>" . PHP_EOL);

        $stereo->on();
    }

    /**
     * Test the off() method of Stereo.
     */
    public function testOff(): void
    {
        $locationId = 'living_room';
        $stereo = new Stereo($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Stereo at $locationId turns off</div>" . PHP_EOL);

        $stereo->off();
    }

    /**
     * Test the setCd() method of Stereo.
     */
    public function testSetCd(): void
    {
        $locationId = 'living_room';
        $stereo = new Stereo($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Stereo at $locationId selected the CD</div>" . PHP_EOL);

        $stereo->setCd();
    }

    /**
     * Test the setDvd() method of Stereo.
     */
    public function testSetDvd(): void
    {
        $locationId = 'living_room';
        $stereo = new Stereo($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Stereo at $locationId selected the DVD</div>" . PHP_EOL);

        $stereo->setDvd();
    }

    /**
     * Test the setVolume() method of Stereo.
     */
    public function testSetVolume(): void
    {
        $locationId = 'living_room';
        $stereo = new Stereo($locationId);
        $volumeLevel = 5;

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Stereo at $locationId volume was set to level $volumeLevel</div>" . PHP_EOL);

        $stereo->setVolume($volumeLevel);
    }
}