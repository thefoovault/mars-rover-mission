<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Service;

use MarsRoverMission\Domain\Map\Dimensions;
use MarsRoverMission\Domain\Map\Exception\ObstacleCollision;
use MarsRoverMission\Domain\Map\Exception\PositionOutOfBounds;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\Rover\Coordinates;

final class CheckAvailablePositionService
{
    public function check(Map $map, Coordinates $coordinates): void
    {
        $this->assertInMap($map->dimensions(), $coordinates);
        $this->assertNotCollisions($map->obstacles(), $coordinates);
    }

    private function assertInMap(Dimensions $dimensions, Coordinates $coordinates): void
    {
        if ($coordinates->x()->value() > $dimensions->width()->value()
            || $coordinates->y()->value() > $dimensions->height()->value()
        ) {
            throw new PositionOutOfBounds($coordinates);
        }
    }

    private function assertNotCollisions(Obstacles $obstacles, Coordinates $coordinates): void
    {
        /** @var Obstacle $obstacle */
        foreach ($obstacles as $obstacle) {
            if ($obstacle->x()->value() === $coordinates->x()->value()
                && $obstacle->y()->value() === $coordinates->y()->value()
            ) {
                throw new ObstacleCollision($obstacle, $coordinates);
            }
        }
    }
}
