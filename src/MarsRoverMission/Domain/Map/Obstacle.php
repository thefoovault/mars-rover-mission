<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\TwoDimensionalPlane\Position;
use Shared\Domain\ValueObject\Point;

final class Obstacle extends Point
{
    public function __construct(Position $x, Position $y)
    {
        parent::__construct($x, $y);
    }
}
