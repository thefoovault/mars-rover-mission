<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\TwoDimensionalPlane\Dimensions;

final class Map
{
    public function __construct(
        private Dimensions $dimensions,
        private Obstacles $obstacles
    ){}

    public function dimensions(): Dimensions
    {
        return $this->dimensions;
    }

    public function obstacles(): Obstacles
    {
        return $this->obstacles;
    }
}
