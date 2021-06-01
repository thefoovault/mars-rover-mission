<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

use MarsRoverMission\Domain\TwoDimensionalPlane\Point;
use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;

final class PointRover extends Point
{
    public function __construct(Coordinates $x, Coordinates $y)
    {
        parent::__construct($x, $y);
    }

    public function sumCoordinates(int $xDiff, int $yDiff): self
    {
        return new self(
            $this->x()->sumPosition($xDiff),
            $this->y()->sumPosition($yDiff)
        );
    }
}
