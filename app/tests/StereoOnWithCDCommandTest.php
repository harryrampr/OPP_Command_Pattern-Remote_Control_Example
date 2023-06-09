<?php

namespace Tests;

use App\Stereo;
use App\StereoOnWithCDCommand;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class StereoOnWithCDCommandTest extends TestCase
{
    /**
     * Test that StereoOnWithCDCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(StereoOnWithCDCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of StereoOnWithCDCommand class for access type and value type.
     */
    public function testStereoOnWithCDCommandProperties(): void
    {
        $expectedResults = [
            'stereo' => ['access' => 'private', 'type' => Stereo::class],
        ];
        $reflectionClass = new ReflectionClass(StereoOnWithCDCommand::class);
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
     * Test the constructor of StereoOnWithCDCommand class.
     */
    public function testStereoOnWithCDCommandConstructor(): void
    {
        // Create a mock Stereo object
        $stereo = $this->createMock(Stereo::class);

        // Create a new StereoOnWithCDCommand instance
        $command = new StereoOnWithCDCommand($stereo);

        // Use reflection to access the private property $stereo
        $reflectionClass = new ReflectionClass(StereoOnWithCDCommand::class);
        $stereoProperty = $reflectionClass->getProperty('stereo');
        $stereoProperty->setAccessible(true);

        // Assert that the private property $stereo was set correctly
        $this->assertSame($stereo, $stereoProperty->getValue($command));
    }

    /**
     * Test the execute() method of StereoOnWithCDCommand class.
     */
    public function testExecute(): void
    {
        // Create a mock Stereo object
        $stereo = $this->createMock(Stereo::class);

        // Create a new StereoOnWithCDCommand instance
        $command = new StereoOnWithCDCommand($stereo);

        // Expect the appropriate methods to be called on the mock Stereo object
        $stereo->expects($this->once())->method('on');
        $stereo->expects($this->once())->method('setCd');
        $stereo->expects($this->once())->method('setVolume')->with(11);

        // Execute the command
        $command->execute();
    }

    /**
     * Test the undo() method of StereoOnWithCDCommand class.
     */
    public function testUndo(): void
    {
        // Create a mock Stereo object
        $stereo = $this->createMock(Stereo::class);

        // Create a new StereoOnWithCDCommand instance
        $command = new StereoOnWithCDCommand($stereo);

        // Use reflection to access the private property $stereo
        $reflectionClass = new ReflectionClass(StereoOnWithCDCommand::class);
        $stereoProperty = $reflectionClass->getProperty('stereo');
        $stereoProperty->setAccessible(true);

        // Set a previous state
        $stereoProperty->setValue($command, $stereo);

        // Expect the appropriate method to be called on the mock Stereo object
        $stereo->expects($this->once())->method('off');

        // Undo the command
        $command->undo();
    }
}