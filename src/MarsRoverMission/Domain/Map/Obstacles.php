<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

use Shared\Domain\Collection;

final class Obstacles extends Collection
{
    protected function type(): string
    {
        return Obstacle::class;
    }
}
