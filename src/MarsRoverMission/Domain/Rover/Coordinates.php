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

    public function sumCoordinates(int $xDiff, int $yDiff): self
    {
        return new self(
            $this->x()->sumPosition($xDiff),
            $this->y()->sumPosition($yDiff)
        );
    }
}
