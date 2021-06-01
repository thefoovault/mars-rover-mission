<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Service;

use MarsRoverMission\Domain\TwoDimensionalPlane\Dimensions;
use MarsRoverMission\Domain\Map\Exception\ObstacleCollision;
use MarsRoverMission\Domain\Map\Exception\PositionOutOfBounds;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\TwoDimensionalPlane\Point;

final class CheckAvailablePositionService
{
    public function check(Map $map, Point $point): void
    {
        $this->assertPointExistsInMap($map->dimensions(), $point);
        $this->assertNotCollisions($map->obstacles(), $point);
    }

    private function assertPointExistsInMap(Dimensions $dimensions, Point $point): void
    {
        if ($point->x()->value() > $dimensions->width()->value()
            || $point->y()->value() > $dimensions->height()->value()
        ) {
            throw new PositionOutOfBounds($point);
        }
    }

    private function assertNotCollisions(Obstacles $obstacles, Point $point): void
    {
        /** @var Obstacle $obstacle */
        foreach ($obstacles as $obstacle) {
            if ($obstacle->x()->value() === $point->x()->value()
                && $obstacle->y()->value() === $point->y()->value()
            ) {
                throw new ObstacleCollision($obstacle, $point);
            }
        }
    }
}
