<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\GarageDoor;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class GarageDoorTest
 *
 * Test class for GarageDoor.
 */
class GarageDoorTest extends TestCase
{
    /**
     * Test properties of GarageDoor class for access type and value type.
     */
    public function testGarageDoorProperties(): void
    {
        $expectedResults = [
            'locationId' => ['access' => 'private', 'type' => 'string'],
        ];
        $reflectionClass = new ReflectionClass(GarageDoor::class);
        $properties = $reflectionClass->getProperties();

        $this->assertSame(count($expectedResults), count($properties));

        foreach ($properties as $property) {
            $propertyName = $property->getName();

            // Test Property Access Type
            match ($expectedResults[$propertyName]['access']) {
                'private' => $this->assertTrue($property->isPrivate(), "Property '$propertyName' should be private."),
                'protected' => $this->assertTrue($property->isProtected(), "Property '$propertyName' should be protected."),
                'public' => $this->assertTrue($property->isPublic(), "Property '$propertyName' should be public."),
                default => $this->fail("Unknown access type on property $propertyName.")
            };

            // Test Property Value Type
            $this->assertSame($expectedResults[$propertyName]['type'], $property->getType()->getName(), "Property '$propertyName' should have the correct type.");
        }
    }

    /**
     * Test the construction of GarageDoor.
     */
    public function testConstruction(): void
    {
        $locationId = 'garage';
        $garageDoor = new GarageDoor($locationId);

        $reflectionClass = new ReflectionClass(GarageDoor::class);

        // Test constructor arguments
        $locationIdProperty = $reflectionClass->getProperty('locationId');
        $locationIdProperty->setAccessible(true);
        $this->assertSame($locationId, $locationIdProperty->getValue($garageDoor));
    }

    /**
     * Test the up() method of GarageDoor.
     */
    public function testUp(): void
    {
        $locationId = 'garage';
        $garageDoor = new GarageDoor($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Garage Door at $locationId goes up</div>" . PHP_EOL);

        $garageDoor->up();
    }

    /**
     * Test the down() method of GarageDoor.
     */
    public function testDown(): void
    {
        $locationId = 'garage';
        $garageDoor = new GarageDoor($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Garage Door at $locationId goes down</div>" . PHP_EOL);

        $garageDoor->down();
    }

    /**
     * Test the lightOn() method of GarageDoor.
     */
    public function testLightOn(): void
    {
        $locationId = 'garage';
        $garageDoor = new GarageDoor($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Garage Door at $locationId light turns on</div>" . PHP_EOL);

        $garageDoor->lightOn();
    }

    /**
     * Test the lightOff() method of GarageDoor.
     */
    public function testLightOff(): void
    {
        $locationId = 'garage';
        $garageDoor = new GarageDoor($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Garage Door at $locationId light turns off</div>" . PHP_EOL);

        $garageDoor->lightOff();
    }

    /**
     * Test the stop() method of GarageDoor.
     */
    public function testStop(): void
    {
        $locationId = 'garage';
        $garageDoor = new GarageDoor($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Garage Door at $locationId stops moving</div>" . PHP_EOL);

        $garageDoor->stop();
    }
}