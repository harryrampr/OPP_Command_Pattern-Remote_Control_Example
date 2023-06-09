<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\GarageDoor;
use App\GarageDoorCloseCommand;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class GarageDoorCloseCommandTest extends TestCase
{
    /**
     * Test that GarageDoorCloseCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(GarageDoorCloseCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of GarageDoorCloseCommand class for access type and value type.
     */
    public function testGarageDoorCloseCommandProperties(): void
    {
        $expectedResults = [
            'garageDoor' => ['access' => 'private', 'type' => GarageDoor::class],
        ];
        $reflectionClass = new ReflectionClass(GarageDoorCloseCommand::class);
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
     * Test the constructor of GarageDoorCloseCommand class.
     */
    public function testGarageDoorCloseCommandConstructor(): void
    {
        // Create a mock GarageDoor object
        $garageDoor = $this->createMock(GarageDoor::class);

        // Create a new GarageDoorCloseCommand instance
        $command = new GarageDoorCloseCommand($garageDoor);

        // Use reflection to access the private property $garageDoor
        $reflectionClass = new ReflectionClass(GarageDoorCloseCommand::class);
        $garageDoorProperty = $reflectionClass->getProperty('garageDoor');
        $garageDoorProperty->setAccessible(true);

        // Assert that the private property $garageDoor was set correctly
        $this->assertSame($garageDoor, $garageDoorProperty->getValue($command));
    }

    /**
     * Test the execute() method of GarageDoorCloseCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock GarageDoor object
        $garageDoor = $this->createMock(GarageDoor::class);

        // Create a new GarageDoorCloseCommand instance
        $command = new GarageDoorCloseCommand($garageDoor);

        // Expect the appropriate method to be called on the mock GarageDoor object
        $garageDoor->expects($this->once())->method('down');

        // Execute the command
        $command->execute();
    }

    /**
     * Test the undo() method of GarageDoorCloseCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock GarageDoor object
        $garageDoor = $this->createMock(GarageDoor::class);

        // Create a new GarageDoorCloseCommand instance
        $command = new GarageDoorCloseCommand($garageDoor);

        // Expect the appropriate method to be called on the mock GarageDoor object
        $garageDoor->expects($this->once())->method('up');

        // Undo the command
        $command->undo();
    }
}