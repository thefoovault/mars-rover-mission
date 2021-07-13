<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Exception;

use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\TwoDimensionalPlane\Point;
use Shared\Domain\Exception\InvalidDataException;

final class ObstacleCollision extends InvalidDataException
{
    private Obstacle $obstacle;
    private Point $coordinates;

    public function __construct(Obstacle $obstacle, Point $coordinates)
    {
        $this->obstacle = $obstacle;
        $this->coordinates = $coordinates;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'obstacle_collision';
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The point (%s, %s) collides with obstacle: (%s, %s)',
            $this->coordinates->x()->value(),
            $this->coordinates->y()->value(),
            $this->obstacle->x()->value(),
            $this->obstacle->y()->value()
        );
    }
}
