<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map;

use JsonSerializable;
use MarsRoverMission\Domain\Map\Map;
use Shared\Domain\Bus\Query\QueryResponse;

final class MapQueryResponse implements QueryResponse, JsonSerializable
{
    use ObstaclesToArray;

    private const DIMENSIONS = 'dimensions';
    private const WIDTH = 'width';
    private const HEIGHT = 'height';
    private const OBSTACLES = 'obstacles';

    private function __construct(
        private array $dimensions,
        private array $obstacles
    ){}

    public static function fromMap(Map $map): self
    {
        return new self(
            [
                self::WIDTH => $map->dimensions()->width()->value(),
                self::HEIGHT => $map->dimensions()->height()->value()
            ],
            self::extractObstaclesToArray($map->obstacles())
        );
    }

    public function dimensions(): array
    {
        return $this->dimensions;
    }

    public function obstacles(): array
    {
        return $this->obstacles;
    }

    public function jsonSerialize(): array
    {
        return [
            self::DIMENSIONS => [
                self::WIDTH => $this->dimensions()[self::WIDTH],
                self::HEIGHT => $this->dimensions()[self::HEIGHT]
            ],
            self::OBSTACLES => $this->obstacles()
        ];
    }
}
