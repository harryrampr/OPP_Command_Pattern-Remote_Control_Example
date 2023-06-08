<?php
declare(strict_types=1);

namespace App;

/**
 * The NoCommand class represents a null object for the Command interface.
 * It does not perform any action when executed or undone.
 */
class NoCommand implements Command
{
    /**
     * Executes the no-op command.
     * This method does not perform any action.
     */
    public function execute(): void
    {
        // TODO: Implement execute() method.
    }

    /**
     * Undoes the no-op command.
     * This method does not perform any action.
     */
    public function undo(): void
    {
        // TODO: Implement undo() method.
    }
}