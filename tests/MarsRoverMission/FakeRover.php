<?php

declare(strict_types=1);

namespace Test\MarsRoverMission;

use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use MarsRoverMission\Domain\Rover\PointRover;
use MarsRoverMission\Domain\Rover\FacingDirection;
use MarsRoverMission\Domain\Rover\Rover;

final class FakeRover
{
    public const X_COORDINATE = 0;
    public const Y_COORDINATE = 0;

    public const NORTH_DIRECTION = 'N';
    public const SOUTH_DIRECTION = 'S';
    public const EAST_DIRECTION = 'E';
    public const WEST_DIRECTION = 'W';

    public const FACING_DIRECTION = self::NORTH_DIRECTION;

    public static function create(): Rover
    {
        return new Rover(
            new PointRover(
                new Coordinates(self::X_COORDINATE),
                new Coordinates(self::Y_COORDINATE)
            ),
            new FacingDirection(self::FACING_DIRECTION)
        );
    }
}
