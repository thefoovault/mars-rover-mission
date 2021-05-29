<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Service;

use MarsRoverMission\Domain\Map\Dimensions;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\Map\Position;

final class ObstacleGenerationService
{
    private const FIRST_POSITION = 0;
    public function generate(Dimensions $dimensions): Obstacles
    {
        $obstacles = [];
        $usedObstacles = [];
        $numberObstacles = $dimensions->width()->value();

        for($i = self::FIRST_POSITION; $i < $numberObstacles; $i++) {
            $obstacleGenerated = false;
            while (!$obstacleGenerated) {
                $obstacle = $this->generateObstacle($dimensions);
                $obstacleGenerated = $this->checkObstacleNotInList($usedObstacles, $obstacle);
            }
            $obstacles[] = $obstacle;
            $usedObstacles[] = $obstacle->x()->value() . ' ' . $obstacle->y()->value();
        }

        return new Obstacles($obstacles);
    }

    private function generateObstacle(Dimensions $dimensions): Obstacle
    {
        $randomX = mt_rand(self::FIRST_POSITION, $dimensions->width()->value());
        $randomY = mt_rand(self::FIRST_POSITION, $dimensions->height()->value());

        return new Obstacle(
            new Position($randomX),
            new Position($randomY)
        );
    }

    private function checkObstacleNotInList(array $obstacles, Obstacle $obstacle): bool
    {
        return !in_array($obstacle->x()->value() . ' ' . $obstacle->y()->value(), $obstacles);
    }
}