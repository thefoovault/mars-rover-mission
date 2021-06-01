<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map;

use MarsRoverMission\Domain\Map\Map;
use Shared\Domain\Bus\Query\QueryResponse;

final class MapQueryResponse implements QueryResponse
{
    use ObstaclesToArray;

    private function __construct(
        private array $dimensions,
        private array $obstacles
    ){}

    public static function fromMap(Map $map): self
    {
        return new self(
            [
                'width' => $map->dimensions()->width()->value(),
                'height' => $map->dimensions()->height()->value()
            ],
            self::extractObstaclesToArray($map->obstacles())
        );
    }

    public function getDimensions(): array
    {
        return $this->dimensions;
    }

    public function getObstacles(): array
    {
        return $this->obstacles;
    }
}
