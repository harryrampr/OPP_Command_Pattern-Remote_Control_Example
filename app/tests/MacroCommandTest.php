<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Tests;

use App\Command;
use App\MacroCommand;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class MacroCommandTest
 *
 * This class contains unit tests for the MacroCommand class.
 * It ensures that the MacroCommand class behaves as expected and its properties and methods are correctly implemented.
 */
class MacroCommandTest extends TestCase
{
    /**
     * Tests if the MacroCommand class implements the Command interface.
     *
     * This test verifies that the MacroCommand class implements the Command interface.
     *
     * @return void
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(MacroCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Tests if the MacroCommand class properties exist, have the correct access type, and correct type.
     *
     * This test verifies that the MacroCommand class has the expected properties with the correct access type and type.
     *
     * @return void
     */
    public function testMacroCommandPropertiesExist(): void
    {
        $expectedResults = [
            'commands' => ['access' => 'private', 'type' => 'array'],
        ];
        $reflectionClass = new ReflectionClass(MacroCommand::class);
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

            // Test Property Type
            $this->assertSame($expectedResults[$propertyName]['type'], $property->getType()->getName());
        }
    }

    /**
     * Tests if the MacroCommand class methods exist, have the correct access type, and correct return type.
     *
     * This test verifies that the MacroCommand class has the expected methods with the correct access type and return
     * type.
     *
     * @return void
     */
    public function testMacroCommandMethodsExist(): void
    {
        $expectedResults = [
            '__construct' => ['access' => 'public', 'return' => ''],
            'execute' => ['access' => 'public', 'return' => 'void'],
            'undo' => ['access' => 'public', 'return' => 'void'],
        ];
        $reflectionClass = new ReflectionClass(MacroCommand::class);
        $methods = $reflectionClass->getMethods();

        $this->assertSame(count($expectedResults), count($methods));

        foreach ($methods as $method) {
            $methodName = $method->getName();

            // Test Method Access Type
            match ($expectedResults[$methodName]['access']) {
                'private' => $this->assertTrue($method->isPrivate()),
                'protected' => $this->assertTrue($method->isProtected()),
                'public' => $this->assertTrue($method->isPublic()),
                default => $this->fail("Unknown access type on method $methodName.")
            };

            // Test Return Type
            $methodType = $method->getReturnType() ? $method->getReturnType()->getName() : '';
            $this->assertSame($expectedResults[$methodName]['return'], $methodType);
        }
    }

    /**
     * Tests if the MacroCommand constructor adds the provided commands to the 'commands' property.
     *
     * This test verifies that the MacroCommand constructor correctly adds the provided commands to the 'commands'
     * property. It creates a new MacroCommand object with a set of commands and checks if the 'commands' property
     * contains the same commands.
     *
     * @return void
     */
    public function testMacroCommandConstructorAddsCommands(): void
    {
        $command1 = $this->createMock(Command::class);
        $command2 = $this->createMock(Command::class);
        $command3 = $this->createMock(Command::class);
        $commands = [$command1, $command2, $command3];
        $macroCommand = new MacroCommand($commands);

        $reflectionClass = new ReflectionClass(MacroCommand::class);
        $commandsProperty = $reflectionClass->getProperty('commands');
        $commandsProperty->setAccessible(true);
        $commandsPropertyValue = $commandsProperty->getValue($macroCommand);

        $this->assertCount(count($commands), $commandsPropertyValue);
        $this->assertSame($commands, $commandsPropertyValue);
    }

    /**
     * Tests if the execute method calls the execute method on each command.
     *
     * This test verifies that the execute method of the MacroCommand class calls the execute method on each command it
     * holds. It creates a new MacroCommand object with a set of commands and expects each command's execute method to
     * be called.
     *
     * @return void
     */
    public function testExecuteCallsExecuteOnCommands(): void
    {
        $command1 = $this->createMock(Command::class);
        $command1->expects($this->once())->method('execute');
        $command2 = $this->createMock(Command::class);
        $command2->expects($this->once())->method('execute');
        $command3 = $this->createMock(Command::class);
        $command3->expects($this->once())->method('execute');
        $commands = [$command1, $command2, $command3];
        $macroCommand = new MacroCommand($commands);

        $macroCommand->execute();
    }

    /**
     * Tests if the undo method calls the undo method on each command.
     *
     * This test verifies that the undo method of the MacroCommand class calls the undo method on each command it holds.
     * It creates a new MacroCommand object with a set of commands and expects each command's undo method to be called.
     *
     * @return void
     */
    public function testUndoCallsUndoOnCommands(): void
    {
        $command1 = $this->createMock(Command::class);
        $command1->expects($this->once())->method('undo');
        $command2 = $this->createMock(Command::class);
        $command2->expects($this->once())->method('undo');
        $command3 = $this->createMock(Command::class);
        $command3->expects($this->once())->method('undo');
        $commands = [$command1, $command2, $command3];
        $macroCommand = new MacroCommand($commands);

        $macroCommand->undo();
    }
}