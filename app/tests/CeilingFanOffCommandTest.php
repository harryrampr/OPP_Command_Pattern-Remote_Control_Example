<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\CeilingFan;
use App\CeilingFanOffCommand;
use App\Speed;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Class CeilingFanOffCommandTest
 */
class CeilingFanOffCommandTest extends TestCase
{
    /**
     * Test that CeilingFanOffCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(CeilingFanOffCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of CeilingFanOffCommand class for access type and value type.
     */
    public function testCeilingFanOffCommandProperties(): void
    {
        $expectedResults = [
            'ceilingFan' => ['access' => 'private', 'type' => CeilingFan::class],
            'prevSpeed' => ['access' => 'private', 'type' => Speed::class],
        ];
        $reflectionClass = new ReflectionClass(CeilingFanOffCommand::class);
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
     * Test the constructor of CeilingFanOffCommand class.
     */
    public function testCeilingFanOffCommandConstructor(): void
    {
        // Create a mock CeilingFan object
        $ceilingFan = $this->createMock(CeilingFan::class);

        // Create a new CeilingFanOffCommand instance
        $command = new CeilingFanOffCommand($ceilingFan);

        // Use reflection to access the private property $ceilingFan
        $reflectionClass = new ReflectionClass(CeilingFanOffCommand::class);
        $ceilingFanProperty = $reflectionClass->getProperty('ceilingFan');
        $ceilingFanProperty->setAccessible(true);

        // Assert that the private property $ceilingFan was set correctly
        $this->assertSame($ceilingFan, $ceilingFanProperty->getValue($command));
    }

    /**
     * Test the execute() method of CeilingFanOffCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock CeilingFan object
        $ceilingFan = new CeilingFan('living_room');

        // Create a new CeilingFanOffCommand instance
        $command = new CeilingFanOffCommand($ceilingFan);

        // Use reflection to access the private property $prevSpeed
        $reflectionClass = new ReflectionClass(CeilingFanOffCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        // Execute the command
        $command->execute();

        // Assert that the prevSpeed property was set correctly
        $this->assertSame(Speed::OFF, $prevSpeedProperty->getValue($command));

        // Use reflection to access the private property $ceilingFan
        $ceilingFanProperty = $reflectionClass->getProperty('ceilingFan');
        $ceilingFanProperty->setAccessible(true);

        // Get the actual CeilingFan object from the command
        $actualCeilingFan = $ceilingFanProperty->getValue($command);

        // Use reflection to access the protected property $speed of the CeilingFan object
        $ceilingFanClass = new ReflectionClass(get_class($actualCeilingFan));
        $speedProperty = $ceilingFanClass->getProperty('speed');
        $speedProperty->setAccessible(true);

        // Assert that the speed property of the CeilingFan object was set to Speed::OFF
        $this->assertSame(Speed::OFF, $speedProperty->getValue($actualCeilingFan));
    }

    /**
     * Test the undo() method of CeilingFanOffCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock CeilingFan object
        $ceilingFan = $this->createMock(CeilingFan::class);

        // Create a new CeilingFanOffCommand instance
        $command = new CeilingFanOffCommand($ceilingFan);

        // Use reflection to access the private property $prevSpeed
        $reflectionClass = new ReflectionClass(CeilingFanOffCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        // Set a previous speed value
        $prevSpeedProperty->setValue($command, Speed::LOW);

        // Use reflection to access the private property $ceilingFan
        $ceilingFanProperty = $reflectionClass->getProperty('ceilingFan');
        $ceilingFanProperty->setAccessible(true);

        // Create a mock CeilingFan object for the previous speed
        $prevCeilingFan = $this->createMock(CeilingFan::class);
        $ceilingFanProperty->setValue($command, $prevCeilingFan);

        // Expect the appropriate method to be called on the mock CeilingFan object
        $prevCeilingFan->expects($this->once())->method('low');

        // Undo the command
        $command->undo();
    }
}