<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

final class Obstacle extends Point
{
    public function __construct(Position $x, Position $y)
    {
        parent::__construct($x, $y);
    }
}
