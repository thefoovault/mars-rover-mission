<?php

declare(strict_types=1);


namespace Test\MarsRoverMission;


use MarsRoverMission\Domain\TwoDimensionalPlane\Dimensions;
use MarsRoverMission\Domain\TwoDimensionalPlane\Height;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use MarsRoverMission\Domain\TwoDimensionalPlane\Width;

final class FakeMap
{
    public const WIDTH = 10;
    public const HEIGHT = 20;
    public const X_COORDINATE = 2;
    public const Y_COORDINATE = 2;

    public static function create(): Map
    {
        return new Map(
            new Dimensions(
                new Width(self::WIDTH),
                new Height(self::HEIGHT)
            ),
            new Obstacles([
                new Obstacle(
                    new Coordinates(self::X_COORDINATE),
                    new Coordinates(self::Y_COORDINATE)
                )
            ])
        );
    }
}
