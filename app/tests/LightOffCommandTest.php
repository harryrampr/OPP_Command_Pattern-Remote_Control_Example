<?php

namespace Tests;

use App\Light;
use App\LightOffCommand;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class LightOffCommandTest extends TestCase
{
    /**
     * Test that LightOffCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(LightOffCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of LightOffCommand class for access type and value type.
     */
    public function testLightOffCommandProperties(): void
    {
        $expectedResults = [
            'light' => ['access' => 'private', 'type' => Light::class],
        ];
        $reflectionClass = new ReflectionClass(LightOffCommand::class);
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
     * Test the constructor of LightOffCommand class.
     */
    public function testLightOffCommandConstructor(): void
    {
        // Create a mock Light object
        $light = $this->createMock(Light::class);

        // Create a new LightOffCommand instance
        $command = new LightOffCommand($light);

        // Use reflection to access the private property $light
        $reflectionClass = new ReflectionClass(LightOffCommand::class);
        $lightProperty = $reflectionClass->getProperty('light');
        $lightProperty->setAccessible(true);

        // Assert that the private property $light was set correctly
        $this->assertSame($light, $lightProperty->getValue($command));
    }

    /**
     * Test the execute() method of LightOffCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock Light object
        $light = $this->createMock(Light::class);

        // Create a new LightOffCommand instance
        $command = new LightOffCommand($light);

        // Expect the appropriate method to be called on the mock Light object
        $light->expects($this->once())->method('off');

        // Execute the command
        $command->execute();
    }

    /**
     * Test the undo() method of LightOffCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock Light object
        $light = $this->createMock(Light::class);

        // Create a new LightOffCommand instance
        $command = new LightOffCommand($light);

        // Expect the appropriate method to be called on the mock Light object
        $light->expects($this->once())->method('on');

        // Undo the command
        $command->undo();
    }
}