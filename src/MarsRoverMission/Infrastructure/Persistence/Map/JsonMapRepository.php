<?php

declare(strict_types=1);

namespace MarsRoverMission\Infrastructure\Persistence\Map;

use MarsRoverMission\Application\Map\ObstaclesToArray;
use MarsRoverMission\Domain\Map\Dimensions;
use MarsRoverMission\Domain\Map\Exception\MapNotFound;
use MarsRoverMission\Domain\Map\Height;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\MapRepository;
use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\Map\Position;
use MarsRoverMission\Domain\Map\Width;

final class JsonMapRepository implements MapRepository
{
    use ObstaclesToArray;

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
            'obstacles' => self::extractObstaclesToArray($map->obstacles())
        ];
    }

    public function find(): Map
    {
        if (!file_exists(self::FILE)) {
            throw new MapNotFound();
        }
        $mapInfo = json_decode(file_get_contents(self::FILE), true);

        return new Map(
            new Dimensions(
                new Width($mapInfo['dimensions']['width']),
                new Height($mapInfo['dimensions']['width'])
            ),
            $this->extractArrayToObstacles($mapInfo['obstacles'])
        );
    }

    private function extractArrayToObstacles(array $obstaclesArray): Obstacles
    {
        $obstacles = [];
        foreach ($obstaclesArray as $obstacle) {
            $obstacles[] = new Obstacle(
                new Position($obstacle['x']),
                new Position($obstacle['y'])
            );
        }
        return new Obstacles($obstacles);
    }
}
