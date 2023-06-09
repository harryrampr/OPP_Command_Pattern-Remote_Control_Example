<?php

namespace Tests;

use App\TV;
use App\TVOffCommand;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class TVOffCommandTest extends TestCase
{
    /**
     * Test that TVOffCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(TVOffCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of TVOffCommand class for access type and value type.
     */
    public function testTVOffCommandProperties(): void
    {
        $expectedResults = [
            'tv' => ['access' => 'private', 'type' => TV::class],
        ];
        $reflectionClass = new ReflectionClass(TVOffCommand::class);
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
     * Test the constructor of TVOffCommand class.
     */
    public function testTVOffCommandConstructor(): void
    {
        // Create a mock TV object
        $tv = $this->createMock(TV::class);

        // Create a new TVOffCommand instance
        $command = new TVOffCommand($tv);

        // Use reflection to access the private property $tv
        $reflectionClass = new ReflectionClass(TVOffCommand::class);
        $tvProperty = $reflectionClass->getProperty('tv');
        $tvProperty->setAccessible(true);

        // Assert that the private property $tv was set correctly
        $this->assertSame($tv, $tvProperty->getValue($command));
    }

    /**
     * Test the execute() method of TVOffCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock TV object
        $tv = $this->createMock(TV::class);

        // Create a new TVOffCommand instance
        $command = new TVOffCommand($tv);

        // Expect the appropriate method to be called on the mock TV object
        $tv->expects($this->once())->method('off');

        // Execute the command
        $command->execute();
    }

    /**
     * Test the undo() method of TVOffCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock TV object
        $tv = $this->createMock(TV::class);

        // Create a new TVOffCommand instance
        $command = new TVOffCommand($tv);

        // Expect the appropriate method to be called on the mock TV object
        $tv->expects($this->once())->method('on');

        // Undo the command
        $command->undo();
    }
}