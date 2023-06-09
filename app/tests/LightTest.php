<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\Light;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class LightTest
 *
 * Test class for Light.
 */
class LightTest extends TestCase
{
    /**
     * Test properties of Light class for access type and value type.
     */
    public function testLightProperties(): void
    {
        $expectedResults = [
            'locationId' => ['access' => 'public', 'type' => 'string'],
        ];
        $reflectionClass = new ReflectionClass(Light::class);
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
     * Test the construction of Light.
     */
    public function testConstruction(): void
    {
        $locationId = 'living_room';
        $light = new Light($locationId);

        $reflectionClass = new ReflectionClass(Light::class);

        // Test constructor argument
        $locationIdProperty = $reflectionClass->getProperty('locationId');
        $locationIdProperty->setAccessible(true);
        $this->assertSame($locationId, $locationIdProperty->getValue($light));
    }

    /**
     * Test the on() method of Light.
     */
    public function testOn(): void
    {
        $locationId = 'living_room';
        $light = new Light($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Light at $locationId turns on</div>" . PHP_EOL);

        $light->on();
    }

    /**
     * Test the off() method of Light.
     */
    public function testOff(): void
    {
        $locationId = 'living_room';
        $light = new Light($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Light at $locationId turns off</div>" . PHP_EOL);

        $light->off();
    }
}