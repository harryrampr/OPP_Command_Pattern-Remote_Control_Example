<?php

namespace App;

/**
 * The MacroCommand class represents a command that groups and executes multiple commands.
 */
class MacroCommand implements Command
{
    /**
     * @var Command[] The array of commands to be executed.
     */
    private array $commands;

    /**
     * MacroCommand constructor.
     *
     * @param Command[] $commands The array of commands to be executed.
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    /**
     * Executes all the commands in the macro command.
     */
    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }

    /**
     * Undoes all the commands in reverse order.
     */
    public function undo(): void
    {
        foreach (array_reverse($this->commands) as $command) {
            $command->undo();
        }
    }
}