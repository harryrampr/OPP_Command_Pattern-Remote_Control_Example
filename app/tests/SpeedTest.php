<?php

namespace Tests;

use App\Speed;
use PHPUnit\Framework\TestCase;

class SpeedTest extends TestCase
{
    public function testSpeedIsEnumerator(): void
    {
        $enumReflection = new \ReflectionEnum(Speed::class);
        $this->assertTrue($enumReflection->isEnum());
    }

    public function testSpeedCases(): void
    {
        $expectedCases = [
            'HIGH' => 3,
            'MEDIUM' => 2,
            'LOW' => 1,
            'OFF' => 0,
        ];

        $enumReflection = new \ReflectionEnum(Speed::class);
        $cases = $enumReflection->getCases();
        $this->assertSame(count($expectedCases), count($cases));

        foreach ($cases as $case) {
            /** @var \ReflectionEnumCase $case */
            $caseName = $case->getName();
            $caseValue = $case->getValue()->value;
            $this->assertContains($caseName, array_keys($expectedCases));
            $this->assertSame($expectedCases[$caseName], $caseValue);
        }
    }

    public function testSpeedSpeedCommandMethod(): void
    {
        $expectedResults = [
            'HIGH' => 'High',
            'MEDIUM' => 'Medium',
            'LOW' => 'Low',
            'OFF' => 'Off'
        ];

        $testClass = new class {
            public function high(): void
            {
                echo 'High';
            }

            public function medium(): void
            {
                echo 'Medium';
            }

            public function low(): void
            {
                echo 'Low';
            }

            public function off(): void
            {
                echo 'Off';
            }
        };

        $object = new $testClass;

        $enumReflection = new \ReflectionEnum(Speed::class);
        $cases = $enumReflection->getCases();
        $this->assertSame(count($expectedResults), count($cases));

        foreach ($cases as $case) {
            /** @var \ReflectionEnumCase $case */
            $caseName = $case->getName();

            // Capture the output of speedCommand
            ob_start();
            constant("App\Speed::$caseName")->speedCommand($object);
            $output = ob_get_clean();

            $this->assertSame($expectedResults[$caseName], $output);
        }
    }
}