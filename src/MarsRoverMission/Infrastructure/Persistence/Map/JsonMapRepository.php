<?php

declare(strict_types=1);

namespace MarsRoverMission\Infrastructure\Persistence\Map;

use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\MapRepository;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;

final class JsonMapRepository implements MapRepository
{
    private const FILE = '../../../etc/data/map.json';

    public function save(Map $map): void
    {
        file_put_contents(self::FILE, json_encode($this->extractMapToArray($map)));
    }

    private function extractMapToArray(Map $map): array
    {
        return [
            'dimensions' => [
                'width' => $map->dimensions()->width()->value(),
                'height' => $map->dimensions()->height()->value()
            ],
            'obstacles' => $this->extractObstaclesToArray($map->obstacles())
        ];
    }

    private function extractObstaclesToArray(Obstacles $obstacles): array
    {
        $obstaclesArray = [];

        foreach ($obstacles as $obstacle) {
            $obstaclesArray[] = $this->extractObstacleToArray($obstacle);
        }

        return $obstaclesArray;
    }

    private function extractObstacleToArray(Obstacle $obstacle): array
    {
        return [
            'x' => $obstacle->x()->value(),
            'y' => $obstacle->y()->value()
        ];
    }
}
