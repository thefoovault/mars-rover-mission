<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\TwoDimensionalPlane\Point;
use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;

final class Obstacle extends Point
{
    public function __construct(Coordinates $x, Coordinates $y)
    {
        parent::__construct($x, $y);
    }
}
