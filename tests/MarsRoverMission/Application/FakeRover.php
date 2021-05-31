<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application;

use MarsRoverMission\Domain\Map\Position;
use MarsRoverMission\Domain\Rover\Coordinates;
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
