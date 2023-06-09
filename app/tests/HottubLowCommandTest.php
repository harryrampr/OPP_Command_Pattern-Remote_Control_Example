<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\Hottub;
use App\HottubLowCommand;
use App\Speed;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

class HottubLowCommandTest extends TestCase
{
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(HottubLowCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    public function testHottubLowCommandProperties(): void
    {
        $expectedResults = [
            'hottub' => ['access' => 'private', 'type' => Hottub::class],
            'prevSpeed' => ['access' => 'private', 'type' => Speed::class],
        ];
        $reflectionClass = new ReflectionClass(HottubLowCommand::class);
        $properties = $reflectionClass->getProperties();

        $this->assertSame(count($expectedResults), count($properties));

        foreach ($properties as $property) {
            $propertyName = $property->getName();

            match ($expectedResults[$propertyName]['access']) {
                'private' => $this->assertTrue($property->isPrivate()),
                'protected' => $this->assertTrue($property->isProtected()),
                'public' => $this->assertTrue($property->isPublic()),
                default => $this->fail("Unknown access type on property $propertyName.")
            };

            $propertyType = $property->getType();
            $this->assertNotNull($propertyType);
            $this->assertInstanceOf(ReflectionNamedType::class, $propertyType);

            $typeName = $propertyType->getName();
            $expectedTypeName = $expectedResults[$propertyName]['type'];
            $this->assertEquals($expectedTypeName, $typeName);
        }
    }

    public function testHottubLowCommandConstructor(): void
    {
        $hottub = $this->createMock(Hottub::class);

        $command = new HottubLowCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubLowCommand::class);
        $hottubProperty = $reflectionClass->getProperty('hottub');

        $this->assertSame($hottub, $hottubProperty->getValue($command));
    }

    public function testExecute(): void
    {
        $hottub = new Hottub('backyard');

        $command = new HottubLowCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubLowCommand::class);
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

        $this->assertSame(Speed::LOW, $speedProperty->getValue($actualHottub));
    }

    public function testUndo(): void
    {
        $hottub = $this->createMock(Hottub::class);

        $command = new HottubLowCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubLowCommand::class);
        $prevSpeedProperty = $reflectionClass->getProperty('prevSpeed');
        $prevSpeedProperty->setAccessible(true);

        $prevSpeedProperty->setValue($command, Speed::HIGH);

        $prevHottub = $this->createMock(Hottub::class);
        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);
        $hottubProperty->setValue($command, $prevHottub);

        $prevHottub->expects($this->once())->method('high');

        $command->undo();
    }
}