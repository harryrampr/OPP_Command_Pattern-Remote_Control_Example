<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\HottubOffCommand;
use App\Hottub;
use App\Speed;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Class HottubOffCommandTest
 */
class HottubOffCommandTest extends TestCase
{
    /**
     * Test that HottubOffCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(HottubOffCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of HottubOffCommand class for access type and value type.
     */
    public function testHottubOffCommandProperties(): void
    {
        $expectedResults = [
            'hottub' => ['access' => 'private', 'type' => 'App\Hottub'],
            'prevSpeed' => ['access' => 'private', 'type' => 'App\Speed'],
        ];
        $reflectionClass = new ReflectionClass(HottubOffCommand::class);
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
     * Test the constructor of HottubOffCommand class.
     */
    public function testHottubOffCommandConstructor(): void
    {
        $hottub = $this->createMock(Hottub::class);
        $command = new HottubOffCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubOffCommand::class);
        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        $this->assertSame($hottub, $hottubProperty->getValue($command));
    }

    /**
     * Test the execute() method of HottubOffCommand class.
     */
    public function testExecute(): void
    {
        $hottub = new Hottub('backyard');
        $command = new HottubOffCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubOffCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        $command->execute();

        $this->assertSame(Speed::OFF, $prevSpeedProperty->getValue($command));

        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        $actualHottub = $hottubProperty->getValue($command);

        $hottubClass = new ReflectionClass(get_class($actualHottub));
        $speedProperty = $hottubClass->getProperty('speed');
        $speedProperty->setAccessible(true);

        $this->assertSame(Speed::OFF, $speedProperty->getValue($actualHottub));
    }

    /**
     * Test the undo() method of HottubOffCommand class.
     */
    public function testUndo(): void
    {
        $hottub = $this->createMock(Hottub::class);
        $command = new HottubOffCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubOffCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        $prevSpeedProperty->setValue($command, Speed::LOW);

        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        $prevHottub = $this->createMock(Hottub::class);
        $hottubProperty->setValue($command, $prevHottub);

        $prevHottub->expects($this->once())->method('low');

        $command->undo();
    }
}