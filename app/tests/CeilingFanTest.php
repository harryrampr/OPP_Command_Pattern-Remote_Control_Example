<?php

namespace Tests;

use App\CeilingFan;
use App\Speed;
use PHPUnit\Framework\TestCase;

/**
 * Class CeilingFanTest
 *
 * Test class for CeilingFan.
 */
class CeilingFanTest extends TestCase
{
    /**
     * Test properties of CeilingFan class for access type and value type.
     */
    public function testCeilingFanProperties(): void
    {
        $expectedResults = [
            'locationId' => ['access' => 'private', 'type' => 'string'],
            'speed' => ['access' => 'private', 'type' => 'App\Speed'],
        ];
        $reflectionClass = new \ReflectionClass(CeilingFan::class);
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
     * Test the construction of CeilingFan.
     */
    public function testConstruction(): void
    {
        $locationId = 'living_room';
        $ceilingFan = new CeilingFan($locationId);

        $reflectionClass = new \ReflectionClass(CeilingFan::class);

        // Test constructor arguments
        $locationIdProperty = $reflectionClass->getProperty('locationId');
        $locationIdProperty->setAccessible(true);
        $this->assertSame($locationId, $locationIdProperty->getValue($ceilingFan));

        // Test initial speed
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::OFF, $speedProperty->getValue($ceilingFan));
    }

    /**
     * Test the off() method of CeilingFan.
     */
    public function testOff(): void
    {
        $locationId = 'living_room';
        $ceilingFan = new CeilingFan($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Ceiling Fan at $locationId turns off</div>" . PHP_EOL);

        $ceilingFan->off();

        // Test speed after turning off
        $reflectionClass = new \ReflectionClass(CeilingFan::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::OFF, $speedProperty->getValue($ceilingFan));
    }

    /**
     * Test the low() method of CeilingFan.
     */
    public function testLow(): void
    {
        $locationId = 'living_room';
        $ceilingFan = new CeilingFan($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Ceiling Fan at $locationId was set to low speed</div>" . PHP_EOL);

        $ceilingFan->low();

        // Test speed after setting to low
        $reflectionClass = new \ReflectionClass(CeilingFan::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::LOW, $speedProperty->getValue($ceilingFan));
    }

    /**
     * Test the medium() method of CeilingFan.
     */
    public function testMedium(): void
    {
        $locationId = 'living_room';
        $ceilingFan = new CeilingFan($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Ceiling Fan at $locationId was set to medium speed</div>" . PHP_EOL);

        $ceilingFan->medium();

        // Test speed after setting to medium
        $reflectionClass = new \ReflectionClass(CeilingFan::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::MEDIUM, $speedProperty->getValue($ceilingFan));
    }

    /**
     * Test the high() method of CeilingFan.
     */
    public function testHigh(): void
    {
        $locationId = 'living_room';
        $ceilingFan = new CeilingFan($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Ceiling Fan at $locationId was set to high speed</div>" . PHP_EOL);

        $ceilingFan->high();

        // Test speed after setting to high
        $reflectionClass = new \ReflectionClass(CeilingFan::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::HIGH, $speedProperty->getValue($ceilingFan));
    }

    /**
     * Test the getSpeed() method of CeilingFan.
     */
    public function testGetSpeed(): void
    {
        $locationId = 'living_room';
        $ceilingFan = new CeilingFan($locationId);

        $this->assertSame(Speed::OFF, $ceilingFan->getSpeed());

        $reflectionClass = new \ReflectionClass(CeilingFan::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $speedProperty->setValue($ceilingFan, Speed::MEDIUM);

        $this->assertSame(Speed::MEDIUM, $ceilingFan->getSpeed());
    }
}