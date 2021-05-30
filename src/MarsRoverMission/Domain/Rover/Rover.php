<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

final class Rover
{
    public function __construct(
        private Coordinates $coordinates,
        private FacingDirection $facingDirection
    ){}

    public function coordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function facingDirection(): FacingDirection
    {
        return $this->facingDirection;
    }
}
