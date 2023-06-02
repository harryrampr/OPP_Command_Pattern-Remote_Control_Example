<?php
declare(strict_types=1);

namespace App;

class TVOffCommand implements Command
{

    private TV $tv;

    public function __construct(TV $tv)
    {
        $this->tv = $tv;
    }

    public function execute(): void
    {
        $this->tv->off();
    }

    public function undo(): void
    {
        $this->tv->on();
    }
}