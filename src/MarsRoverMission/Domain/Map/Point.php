<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

abstract class Point
{
    public function __construct(
        protected Position $x,
        protected Position $y
    ){}

    public function x(): Position
    {
        return $this->x;
    }

    public function y(): Position
    {
        return $this->y;
    }
}
