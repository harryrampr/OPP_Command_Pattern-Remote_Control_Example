<?php
declare(strict_types=1);

namespace App;

/**
 * The Command interface represents an action that can be executed and undone.
 */
interface Command
{
    /**
     * Executes the command.
     *
     * This method performs the necessary operations to carry out the command.
     *
     * @return void
     */
    public function execute(): void;

    /**
     * Undoes the command.
     *
     * This method reverses the operations performed by the execute() method, effectively undoing the command.
     *
     * @return void
     */
    public function undo(): void;
}