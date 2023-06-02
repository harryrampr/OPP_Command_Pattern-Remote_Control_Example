<?php

namespace App;

class MacroCommand implements Command
{
    /** @var Command[] $commands */
    private array $commands;

    /**
     * @param Command[] $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }

    public function undo(): void
    {
        foreach ($this->commands as $command) {
            $command->undo();
        }
    }
}