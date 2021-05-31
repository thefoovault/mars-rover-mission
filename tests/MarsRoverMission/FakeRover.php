<?php

declare(strict_types=1);

namespace Test\MarsRoverMission;

use MarsRoverMission\Domain\TwoDimensionalPlane\Position;
use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use MarsRoverMission\Domain\Rover\FacingDirection;
use MarsRoverMission\Domain\Rover\Rover;

final class FakeRover
{
    public static function create(): Rover
    {
        return new Rover(
            new Coordinates(
                new Position(0),
                new Position(0)
            ),
            new FacingDirection('N')
        );
    }
}
