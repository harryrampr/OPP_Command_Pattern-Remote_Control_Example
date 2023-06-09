<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\Hottub;
use App\HottubHighCommand;
use PHPUnit\Framework\TestCase;
use App\Speed;
use App\Command;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Class HottubHighCommandTest
 */
class HottubHighCommandTest extends TestCase
{
    /**
     * Test that HottubHighCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(HottubHighCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of HottubHighCommand class for access type and value type.
     */
    public function testHottubHighCommandProperties(): void
    {
        $expectedResults = [
            'hottub' => ['access' => 'private', 'type' => 'App\Hottub'],
            'prevSpeed' => ['access' => 'private', 'type' => 'App\Speed'],
        ];
        $reflectionClass = new ReflectionClass(HottubHighCommand::class);
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
            $propertyType = $property->getType();
            $this->assertNotNull($propertyType);
            $this->assertInstanceOf(ReflectionNamedType::class, $propertyType);

            $typeName = $propertyType->getName();
            $expectedTypeName = $expectedResults[$propertyName]['type'];
            $this->assertEquals($expectedTypeName, $typeName);
        }
    }

    /**
     * Test the constructor of HottubHighCommand class.
     */
    public function testHottubHighCommandConstructor(): void
    {
        // Create a mock Hottub object
        $hottub = $this->createMock(Hottub::class);

        // Create a new HottubHighCommand instance
        $command = new HottubHighCommand($hottub);

        // Use reflection to access the private property $hottub
        $reflectionClass = new ReflectionClass(HottubHighCommand::class);
        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        // Assert that the private property $hottub was set correctly
        $this->assertSame($hottub, $hottubProperty->getValue($command));
    }

    /**
     * Test the execute() method of HottubHighCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock Hottub object
        $hottub = new Hottub('backyard');

        // Create a new HottubHighCommand instance
        $command = new HottubHighCommand($hottub);

        // Use reflection to access the private property $prevSpeed
        $reflectionClass = new ReflectionClass(HottubHighCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        // Execute the command
        $command->execute();

        // Assert that the prevSpeed property was set correctly
        $this->assertSame(Speed::OFF, $prevSpeedProperty->getValue($command));

        // Use reflection to access the private property $hottub
        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        // Get the actual Hottub object from the command
        $actualHottub = $hottubProperty->getValue($command);

        // Use reflection to access the protected property $speed of the Hottub object
        $hottubClass = new ReflectionClass(get_class($actualHottub));
        $speedProperty = $hottubClass->getProperty('speed');
        $speedProperty->setAccessible(true);

        // Assert that the speed property of the Hottub object was set to Speed::HIGH
        $this->assertSame(Speed::HIGH, $speedProperty->getValue($actualHottub));
    }

    /**
     * Test the undo() method of HottubHighCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock Hottub object
        $hottub = $this->createMock(Hottub::class);

        // Create a new HottubHighCommand instance
        $command = new HottubHighCommand($hottub);

        // Use reflection to access the private property $prevSpeed
        $reflectionClass = new ReflectionClass(HottubHighCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        // Set a previous speed value
        $prevSpeedProperty->setValue($command, Speed::LOW);

        // Use reflection to access the private property $hottub
        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        // Create a mock Hottub object for the previous speed
        $prevHottub = $this->createMock(Hottub::class);
        $hottubProperty->setValue($command, $prevHottub);

        // Expect the appropriate method to be called on the mock Hottub object
        $prevHottub->expects($this->once())->method('low');

        // Undo the command
        $command->undo();
    }
}