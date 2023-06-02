<?php
declare(strict_types=1);

namespace App;

class RemoteControl
{
    const SLOTS = 7;

    /** @var Command[] $onCommands */
    private array $onCommands;

    /** @var Command[] $offCommands */
    private array $offCommands;

    private Command $undoCommand;

    public function __construct()
    {
        $noCommand = new NoCommand();
        for ($i = 0; $i < self::SLOTS; $i++) {
            $this->onCommands[$i] = $noCommand;
            $this->offCommands[$i] = $noCommand;
        }
        $this->undoCommand = $noCommand;
    }

    public function setCommand(int $slot, Command $onCommand, Command $offCommand): void
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    public function onButtonWasPressed(int $slot): void
    {
        echo sprintf("</div>\n<div class=\"test\">\n<div class=\"pressed\">On Button #%d was pressed:</div>%s",
            $slot + 1, PHP_EOL);
        $this->onCommands[$slot]->execute();
        $this->undoCommand = $this->onCommands[$slot];
    }

    public function offButtonWasPressed(int $slot): void
    {
        echo sprintf("</div>\n<div class=\"test\">\n<div class=\"pressed\">Off Button #%d was pressed:</div>%s",
            $slot + 1, PHP_EOL);
        $this->offCommands[$slot]->execute();
        $this->undoCommand = $this->offCommands[$slot];
    }

    public function undoButtonWasPushed(): void
    {
        echo sprintf("</div>\n<div class=\"test\">\n<div class=\"undo\">Undo Button was pressed:</div>%s", PHP_EOL);
        $this->undoCommand->undo();
    }

    public function __toString(): string
    {
        $str = "</div>\n<h2>Remote Control</h2>" . PHP_EOL;
        $str .= '<div class="grid grid-cols-5 gap-6 w-192 mb-[6rem]">' . PHP_EOL;
        for ($i = 0; $i < self::SLOTS; $i++) {
            $str .= '<div class="slot">';
            $str .= "slot $i";
            $str .= "</div>\n<div class=\"col-span-2 command\">";
            $str .= basename(get_class($this->onCommands[$i]));
            $str .= "</div>\n<div class=\"col-span-2 command\">";
            $str .= basename(get_class($this->offCommands[$i]));
            $str .= '</div>' . PHP_EOL;
        }
        $str .= '<div class="slot">undo';
        $str .= "</div>\n<div class=\"col-span-2 command\">";
        $str .= basename(get_class($this->undoCommand));
        $str .= "</div>\n</div>\n<div>" . PHP_EOL;

        return $str;
    }

}