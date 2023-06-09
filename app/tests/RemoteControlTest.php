<?php

namespace Tests;

use App\RemoteControl;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class RemoteControlTest
 *
 * This class contains unit tests for the RemoteControl class.
 * It ensures that the RemoteControl class behaves as expected and its properties and methods are correctly implemented.
 */
class RemoteControlTest extends TestCase
{
    /**
     * Tests if the RemoteControl class constant SLOTS exists and has the correct value.
     *
     * This test verifies that the RemoteControl class has the constant SLOTS defined with a value of 7.
     *
     * @return void
     */
    public function testRemoteControlConstantsExist(): void
    {
        $this->assertSame(7, RemoteControl::SLOTS);
    }

    /**
     * Tests if the RemoteControl class properties exist, have the correct access type, and correct type.
     *
     * This test verifies that the RemoteControl class has the expected properties with the correct access type and
     * type.
     *
     * @return void
     */
    public function testRemoteControlPropertiesExist(): void
    {
        $expectedResults = [
            'onCommands' => ['access' => 'private', 'type' => 'array'],
            'offCommands' => ['access' => 'private', 'type' => 'array'],
            'undoCommand' => ['access' => 'private', 'type' => 'App\Command'],
        ];
        $reflectionClass = new ReflectionClass(RemoteControl::class);
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
     * Tests if the RemoteControl class methods exist, have the correct access type, and correct return type.
     *
     * This test verifies that the RemoteControl class has the expected methods with the correct access type and return
     * type.
     *
     * @return void
     */
    public function testRemoteControlMethodsExist(): void
    {
        $expectedResults = [
            'setCommand' => ['access' => 'public', 'return' => 'void'],
            'onButtonWasPressed' => ['access' => 'public', 'return' => 'void'],
            'offButtonWasPressed' => ['access' => 'public', 'return' => 'void'],
            'undoButtonWasPushed' => ['access' => 'public', 'return' => 'void'],
            '__toString' => ['access' => 'public', 'return' => 'string'],
            '__construct' => ['access' => 'public', 'return' => ''],
        ];
        $reflectionClass = new ReflectionClass(RemoteControl::class);
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
            $methodReturnTypeName = $methodReturnType ? $methodReturnType->getName() : '';

            $this->assertSame($methodReturnTypeName, $expectedResults[$methodName]['return']);
        }
    }
}