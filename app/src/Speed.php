<?php declare(strict_types=1);

namespace App;
enum Speed: int
{
    case HIGH = 3;
    case MEDIUM = 2;
    case LOW = 1;
    case OFF = 0;
}