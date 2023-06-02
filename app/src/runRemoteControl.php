<?php
declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\CeilingFan;
use App\CeilingFanHighCommand;
use App\CeilingFanLowCommand;
use App\CeilingFanMediumCommand;
use App\CeilingFanOffCommand;
use App\GarageDoor;
use App\GarageDoorCloseCommand;
use App\GarageDoorOpenCommand;
use App\Hottub;
use App\HottubHighCommand;
use App\HottubOffCommand;
use App\Light;
use App\LightOffCommand;
use App\LightOnCommand;
use App\MacroCommand;
use App\RemoteControl;
use App\Stereo;
use App\StereoOffCommand;
use App\StereoOnCommand;
use App\StereoOnWithCDCommand;
use App\TV;
use App\TVOffCommand;
use App\TVOnCommand;

$remoteControl = new RemoteControl();
echo "<div>";

$livingRoomLight = new Light('Living Room');
$livingRoomLightOn = new LightOnCommand($livingRoomLight);
$livingRoomLightOff = new LightOffCommand($livingRoomLight);

$remoteControl->setCommand(0, $livingRoomLightOn, $livingRoomLightOff);
$remoteControl->onButtonWasPressed(0);
$remoteControl->offButtonWasPressed(0);

$kitchenLight = new Light('Kitchen');
$kitchenLightOn = new LightOnCommand($kitchenLight);
$kitchenLightOff = new LightOffCommand($kitchenLight);

$remoteControl->setCommand(1, $kitchenLightOn, $kitchenLightOff);
$remoteControl->onButtonWasPressed(1);
$remoteControl->offButtonWasPressed(1);

$garageDoor = new GarageDoor('Home');
$garageDoorOpen = new GarageDoorOpenCommand($garageDoor);
$garageDoorClose = new GarageDoorCloseCommand($garageDoor);

$remoteControl->setCommand(2, $garageDoorOpen, $garageDoorClose);
$remoteControl->onButtonWasPressed(2);
$remoteControl->offButtonWasPressed(2);


$stereo = new Stereo('Living Room');
$stereoOn = new StereoOnCommand($stereo);
$stereoOnCD = new StereoOnWithCDCommand($stereo);
$stereoOff = new StereoOffCommand($stereo);

$remoteControl->setCommand(3, $stereoOnCD, $stereoOff);
$remoteControl->onButtonWasPressed(3);
$remoteControl->offButtonWasPressed(3);

// Test Undo
$remoteControl->onButtonWasPressed(0);
$remoteControl->offButtonWasPressed(0);
echo $remoteControl;
$remoteControl->undoButtonWasPushed();

$remoteControl->offButtonWasPressed(0);
$remoteControl->onButtonWasPressed(0);
echo $remoteControl;
$remoteControl->undoButtonWasPushed();

$ceilingFan = new CeilingFan('Living Room');
$ceilingFanHigh = new CeilingFanHighCommand($ceilingFan);
$ceilingFanMedium = new CeilingFanMediumCommand($ceilingFan);
$ceilingFanLow = new CeilingFanLowCommand($ceilingFan);
$ceilingFanOff = new CeilingFanOffCommand($ceilingFan);

$remoteControl->setCommand(4, $ceilingFanMedium, $ceilingFanOff);
$remoteControl->onButtonWasPressed(4);
$remoteControl->offButtonWasPressed(4);
echo $remoteControl;
$remoteControl->undoButtonWasPushed();

$remoteControl->setCommand(5, $ceilingFanHigh, $ceilingFanOff);
$remoteControl->onButtonWasPressed(5);
echo $remoteControl;
$remoteControl->undoButtonWasPushed();

// Test Macros
$tv = new TV('Living Room');
$tvOn = new TVOnCommand($tv);
$tvOff = new TVOffCommand($tv);
$hottub = new Hottub('Living Room');
$hottubHigh = new HottubHighCommand($hottub);
$hottubOff = new HottubOffCommand($hottub);


$partyOn = [$livingRoomLightOn, $stereoOn, $tvOn, $hottubHigh];
$partyOff = [$livingRoomLightOff, $stereoOff, $tvOff, $hottubOff];
$partyOnMacro = new MacroCommand($partyOn);
$partyOffMacro = new MacroCommand($partyOff);

$remoteControl->setCommand(6, $partyOnMacro, $partyOffMacro);
$remoteControl->onButtonWasPressed(6);
$remoteControl->offButtonWasPressed(6);

echo $remoteControl;

echo "</div>";
echo "</div>";