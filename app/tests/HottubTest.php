<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\Hottub;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use App\Speed;

/**
 * Class HottubTest
 *
 * Test class for Hottub.
 */
class HottubTest extends TestCase
{
    /**
     * Test properties of Hottub class for access type and value type.
     */
    public function testHottubProperties(): void
    {
        $expectedResults = [
            'locationId' => ['access' => 'private', 'type' => 'string'],
            'speed' => ['access' => 'private', 'type' => 'App\Speed'],
        ];
        $reflectionClass = new ReflectionClass(Hottub::class);
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
     * Test the construction of Hottub.
     */
    public function testConstruction(): void
    {
        $locationId = 'backyard';
        $hottub = new Hottub($locationId);

        $reflectionClass = new ReflectionClass(Hottub::class);

        // Test constructor argument
        $locationIdProperty = $reflectionClass->getProperty('locationId');
        $locationIdProperty->setAccessible(true);
        $this->assertSame($locationId, $locationIdProperty->getValue($hottub));

        // Test initial speed
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::OFF, $speedProperty->getValue($hottub));
    }

    /**
     * Test the off() method of Hottub.
     */
    public function testOff(): void
    {
        $locationId = 'backyard';
        $hottub = new Hottub($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Hot-tub at $locationId turns off</div>" . PHP_EOL);

        $hottub->off();

        // Test speed after turning off
        $reflectionClass = new ReflectionClass(Hottub::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::OFF, $speedProperty->getValue($hottub));
    }

    /**
     * Test the low() method of Hottub.
     */
    public function testLow(): void
    {
        $locationId = 'backyard';
        $hottub = new Hottub($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Hot-tub at $locationId was set to low speed</div>" . PHP_EOL);

        $hottub->low();

        // Test speed after setting to low
        $reflectionClass = new ReflectionClass(Hottub::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::LOW, $speedProperty->getValue($hottub));
    }

    /**
     * Test the medium() method of Hottub.
     */
    public function testMedium(): void
    {
        $locationId = 'backyard';
        $hottub = new Hottub($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Hot-tub at $locationId was set to medium speed</div>" . PHP_EOL);

        $hottub->medium();

        // Test speed after setting to medium
        $reflectionClass = new ReflectionClass(Hottub::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::MEDIUM, $speedProperty->getValue($hottub));
    }

    /**
     * Test the high() method of Hottub.
     */
    public function testHigh(): void
    {
        $locationId = 'backyard';
        $hottub = new Hottub($locationId);

        // Mock echo statement
        $this->expectOutputString(
            "<div class=\"action\">Hot-tub at $locationId was set to high speed</div>" . PHP_EOL);

        $hottub->high();

        // Test speed after setting to high
        $reflectionClass = new ReflectionClass(Hottub::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $this->assertSame(Speed::HIGH, $speedProperty->getValue($hottub));
    }

    /**
     * Test the getSpeed() method of Hottub.
     */
    public function testGetSpeed(): void
    {
        $locationId = 'backyard';
        $hottub = new Hottub($locationId);

        $this->assertSame(Speed::OFF, $hottub->getSpeed());

        $reflectionClass = new ReflectionClass(Hottub::class);
        $speedProperty = $reflectionClass->getProperty('speed');
        $speedProperty->setAccessible(true);
        $speedProperty->setValue($hottub, Speed::MEDIUM);

        $this->assertSame(Speed::MEDIUM, $hottub->getSpeed());
    }
}