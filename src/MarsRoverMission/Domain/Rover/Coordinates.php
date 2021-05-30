<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

use MarsRoverMission\Domain\Map\Point;
use MarsRoverMission\Domain\Map\Position;

final class Coordinates extends Point
{
    public function __construct(Position $x, Position $y)
    {
        parent::__construct($x, $y);
    }
}
