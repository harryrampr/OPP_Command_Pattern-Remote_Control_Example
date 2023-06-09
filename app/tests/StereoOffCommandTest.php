<?php

namespace Tests;

use App\Stereo;
use App\StereoOffCommand;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class StereoOffCommandTest extends TestCase
{
    /**
     * Test that StereoOffCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(StereoOffCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of StereoOffCommand class for access type and value type.
     */
    public function testStereoOffCommandProperties(): void
    {
        $expectedResults = [
            'stereo' => ['access' => 'private', 'type' => Stereo::class],
        ];
        $reflectionClass = new ReflectionClass(StereoOffCommand::class);
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
     * Test the constructor of StereoOffCommand class.
     */
    public function testStereoOffCommandConstructor(): void
    {
        // Create a mock Stereo object
        $stereo = $this->createMock(Stereo::class);

        // Create a new StereoOffCommand instance
        $command = new StereoOffCommand($stereo);

        // Use reflection to access the private property $stereo
        $reflectionClass = new ReflectionClass(StereoOffCommand::class);
        $stereoProperty = $reflectionClass->getProperty('stereo');
        $stereoProperty->setAccessible(true);

        // Assert that the private property $stereo was set correctly
        $this->assertSame($stereo, $stereoProperty->getValue($command));
    }

    /**
     * Test the execute() method of StereoOffCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock Stereo object
        $stereo = $this->createMock(Stereo::class);

        // Create a new StereoOffCommand instance
        $command = new StereoOffCommand($stereo);

        // Expect the appropriate method to be called on the mock Stereo object
        $stereo->expects($this->once())->method('off');

        // Execute the command
        $command->execute();
    }

    /**
     * Test the undo() method of StereoOffCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock Stereo object
        $stereo = $this->createMock(Stereo::class);

        // Create a new StereoOffCommand instance
        $command = new StereoOffCommand($stereo);

        // Use reflection to access the private property $stereo
        $reflectionClass = new ReflectionClass(StereoOffCommand::class);
        $stereoProperty = $reflectionClass->getProperty('stereo');
        $stereoProperty->setAccessible(true);

        // Set a previous state
        $stereoProperty->setValue($command, $stereo);

        // Expect the appropriate method to be called on the mock Stereo object
        $stereo->expects($this->once())->method('on');

        // Undo the command
        $command->undo();
    }
}