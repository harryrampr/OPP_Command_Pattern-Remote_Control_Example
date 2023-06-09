<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\Hottub;
use App\HottubMediumCommand;
use App\Speed;
use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Class HottubMediumCommandTest
 */
class HottubMediumCommandTest extends TestCase
{
    /**
     * Test that HottubMediumCommand class implements Command interface.
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(HottubMediumCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Test properties of HottubMediumCommand class for access type and value type.
     */
    public function testHottubMediumCommandProperties(): void
    {
        $expectedResults = [
            'hottub' => ['access' => 'private', 'type' => 'App\Hottub'],
            'prevSpeed' => ['access' => 'private', 'type' => 'App\Speed'],
        ];
        $reflectionClass = new ReflectionClass(HottubMediumCommand::class);
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
     * Test the constructor of HottubMediumCommand class.
     */
    public function testHottubMediumCommandConstructor(): void
    {
        $hottub = $this->createMock(Hottub::class);
        $command = new HottubMediumCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubMediumCommand::class);
        $hottubProperty = $reflectionClass->getProperty('hottub');
        $hottubProperty->setAccessible(true);

        $this->assertSame($hottub, $hottubProperty->getValue($command));
    }

    /**
     * Test the execute() method of HottubMediumCommand class.
     */
    public function testExecute(): void
    {
        $hottub = new Hottub('backyard');
        $command = new HottubMediumCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubMediumCommand::class);
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

        $this->assertSame(Speed::MEDIUM, $speedProperty->getValue($actualHottub));
    }

    /**
     * Test the undo() method of HottubMediumCommand class.
     */
    public function testUndo(): void
    {
        $hottub = $this->createMock(Hottub::class);
        $command = new HottubMediumCommand($hottub);

        $reflectionClass = new ReflectionClass(HottubMediumCommand::class);
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