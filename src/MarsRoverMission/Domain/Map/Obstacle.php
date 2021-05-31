<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\TwoDimensionalPlane\Point;
use MarsRoverMission\Domain\TwoDimensionalPlane\Position;

final class Obstacle extends Point
{
    public function __construct(Position $x, Position $y)
    {
        parent::__construct($x, $y);
    }
}
