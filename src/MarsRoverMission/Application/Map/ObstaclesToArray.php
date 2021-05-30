<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map;

use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;

trait ObstaclesToArray
{
    private static function extractObstaclesToArray(Obstacles $obstacles): array
    {
        $obstaclesArray = [];

        foreach ($obstacles as $obstacle) {
            $obstaclesArray[] = self::extractObstacleToArray($obstacle);
        }

        return $obstaclesArray;
    }

    private static function extractObstacleToArray(Obstacle $obstacle): array
    {
        return [
            'x' => $obstacle->x()->value(),
            'y' => $obstacle->y()->value()
        ];
    }
}
