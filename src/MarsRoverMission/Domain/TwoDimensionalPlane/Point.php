<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\TwoDimensionalPlane;

abstract class Point
{
    public function __construct(
        protected Coordinates $x,
        protected Coordinates $y
    ){}

    public function x(): Coordinates
    {
        return $this->x;
    }

    public function y(): Coordinates
    {
        return $this->y;
    }
}
