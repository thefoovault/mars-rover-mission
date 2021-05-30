<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map;

use MarsRoverMission\Domain\Map\Map;
use Shared\Domain\Bus\Query\QueryResponse;

final class MapQueryResponse implements QueryResponse
{
    use ObstaclesToArray;

    private function __construct(
        private int $width,
        private int $height,
        private array $obstacles
    ){}

    public static function fromMap(Map $map): self
    {
        return new self(
            $map->dimensions()->width()->value(),
            $map->dimensions()->height()->value(),
            self::extractObstaclesToArray($map->obstacles())
        );
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getObstacles(): array
    {
        return $this->obstacles;
    }
}
