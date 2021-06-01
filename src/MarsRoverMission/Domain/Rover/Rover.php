<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

use MarsRoverMission\Domain\Rover\PointRover;

final class Rover
{
    public function __construct(
        private PointRover $coordinates,
        private FacingDirection $facingDirection
    ){}

    public function coordinates(): PointRover
    {
        return $this->coordinates;
    }

    public function facingDirection(): FacingDirection
    {
        return $this->facingDirection;
    }

    public function nextCoordinateIWantToMove(): PointRover
    {
        $xIncrement = 0;
        $yIncrement = 0;

        if ($this->facingDirection()->isNorth()) {
            $yIncrement += 1;
        } elseif ($this->facingDirection()->isSouth()) {
            $yIncrement -= 1;
        } elseif ($this->facingDirection()->isEast()) {
            $xIncrement += 1;
        } elseif ($this->facingDirection()->isWest()) {
            $xIncrement -= 1;
        }

        return $this->coordinates()->sumCoordinates($xIncrement, $yIncrement);
    }

    public function moveForward(): void
    {
        $this->coordinates = $this->nextCoordinateIWantToMove();;
    }

    public function moveLeft(): void
    {
        $this->facingDirection = $this->facingDirection()->leftFacingDirection();
    }

    public function moveRight(): void
    {
        $this->facingDirection = $this->facingDirection()->rightFacingDirection();
    }
}
