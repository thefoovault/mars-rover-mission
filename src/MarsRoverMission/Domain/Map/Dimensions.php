<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

final class Dimensions
{
    public function __construct(
        private Width $width,
        private Height $height
    ){}

    public function height(): Height
    {
        return $this->height;
    }

    public function width(): Width
    {
        return $this->width;
    }
}
