<?php

namespace Tests;

use App\Command;
use App\NoCommand;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class NoCommandTest
 *
 * This class contains unit tests for the NoCommand class.
 * It ensures that the NoCommand class behaves as expected and conforms to the Command interface.
 */
class NoCommandTest extends TestCase
{
    /**
     * Tests if the NoCommand class implements the Command interface.
     *
     * @return void
     */
    public function testImplementsCommandInterface(): void
    {
        $reflectionClass = new ReflectionClass(NoCommand::class);
        $interfaces = $reflectionClass->getInterfaceNames();

        $this->assertTrue(in_array(Command::class, $interfaces));
    }

    /**
     * Tests the methods of the NoCommand class.
     *
     * This test verifies the methods of the NoCommand class, including their access type and return type.
     *
     * @return void
     */
    public function testNoCommandMethodsExist(): void
    {
        $expectedResults = [
            'execute' => ['access' => 'public', 'return' => 'void'],
            'undo' => ['access' => 'public', 'return' => 'void'],
        ];
        $reflectionClass = new ReflectionClass(NoCommand::class);
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

            // Test Method Return Type
            $methodReturnType = $method->getReturnType();
            $this->assertNotNull($methodReturnType);
            $this->assertSame($expectedResults[$methodName]['return'], $methodReturnType->__toString());
        }
    }
}