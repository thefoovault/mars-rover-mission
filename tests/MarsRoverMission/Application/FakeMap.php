<?php

declare(strict_types=1);


namespace Test\MarsRoverMission\Application;


use MarsRoverMission\Domain\Map\Dimensions;
use MarsRoverMission\Domain\Map\Height;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\TwoDimensionalPlane\Position;
use MarsRoverMission\Domain\Map\Width;

final class FakeMap
{
    public static function create(): Map
    {
        return new Map(
            new Dimensions(
                new Width(10),
                new Height(20)
            ),
            new Obstacles([
                new Obstacle(
                    new Position(2),
                    new Position(2)
                )
            ])
        );
    }
}
