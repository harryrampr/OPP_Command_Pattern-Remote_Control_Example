<?php

namespace Tests;

use App\Command;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class CommandTest
 *
 * This class contains unit tests for the Command interface.
 * It ensures that the Command interface is correctly defined and its properties are implemented as expected.
 */
class CommandTest extends TestCase
{
    /**
     * Tests if the Command interface is defined.
     *
     * This test verifies that the Command interface is defined by checking if the reflection class
     * indicates that the class is an interface.
     *
     * @return void
     */
    public function testCommandIsAnInterface(): void
    {
        $reflectionClass = new ReflectionClass(Command::class);
        $this->assertTrue($reflectionClass->isInterface());
    }

    /**
     * Tests if the Command interface methods exist, have the correct access type, and correct return type.
     *
     * This test verifies that the Command interface has the expected methods with the correct access type and return
     * type. It compares the expected results with the actual methods obtained using reflection.
     *
     * @return void
     */
    public function testCommandPropertiesExist(): void
    {
        $expectedResults = [
            'execute' => ['access' => 'public', 'return' => 'void'],
            'undo' => ['access' => 'public', 'return' => 'void'],
        ];
        $reflectionClass = new ReflectionClass(Command::class);
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
            $returnType = $method->getReturnType();
            $this->assertSame($expectedResults[$methodName]['return'], $returnType->getName());
        }
    }
}