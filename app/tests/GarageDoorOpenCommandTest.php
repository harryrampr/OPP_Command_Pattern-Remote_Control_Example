<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\GarageDoor;
use App\GarageDoorOpenCommand;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class GarageDoorOpenCommandTest extends TestCase
{
    /**
     * Test that GarageDoorOpenCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(GarageDoorOpenCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of GarageDoorOpenCommand class for access type and value type.
     */
    public function testGarageDoorOpenCommandProperties(): void
    {
        $expectedResults = [
            'garageDoor' => ['access' => 'private', 'type' => GarageDoor::class],
        ];
        $reflectionClass = new ReflectionClass(GarageDoorOpenCommand::class);
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
     * Test the constructor of GarageDoorOpenCommand class.
     */
    public function testGarageDoorOpenCommandConstructor(): void
    {
        // Create a mock GarageDoor object
        $garageDoor = $this->createMock(GarageDoor::class);

        // Create a new GarageDoorOpenCommand instance
        $command = new GarageDoorOpenCommand($garageDoor);

        // Use reflection to access the private property $garageDoor
        $reflectionClass = new ReflectionClass(GarageDoorOpenCommand::class);
        $garageDoorProperty = $reflectionClass->getProperty('garageDoor');
        $garageDoorProperty->setAccessible(true);

        // Assert that the private property $garageDoor was set correctly
        $this->assertSame($garageDoor, $garageDoorProperty->getValue($command));
    }

    /**
     * Test the execute() method of GarageDoorOpenCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock GarageDoor object
        $garageDoor = $this->createMock(GarageDoor::class);

        // Create a new GarageDoorOpenCommand instance
        $command = new GarageDoorOpenCommand($garageDoor);

        // Expect the appropriate method to be called on the mock GarageDoor object
        $garageDoor->expects($this->once())->method('up');

        // Execute the command
        $command->execute();
    }

    /**
     * Test the undo() method of GarageDoorOpenCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock GarageDoor object
        $garageDoor = $this->createMock(GarageDoor::class);

        // Create a new GarageDoorOpenCommand instance
        $command = new GarageDoorOpenCommand($garageDoor);

        // Use reflection to access the private property $garageDoor
        $reflectionClass = new ReflectionClass(GarageDoorOpenCommand::class);
        $garageDoorProperty = $reflectionClass->getProperty('garageDoor');
        $garageDoorProperty->setAccessible(true);

        // Set a previous state
        $garageDoorProperty->setValue($command, $garageDoor);

        // Expect the appropriate method to be called on the mock GarageDoor object
        $garageDoor->expects($this->once())->method('down');

        // Undo the command
        $command->undo();
    }
}