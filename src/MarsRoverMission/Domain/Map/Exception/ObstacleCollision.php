<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Exception;

use MarsRoverMission\Domain\Map\Obstacle;
use MarsRoverMission\Domain\Rover\Coordinates;
use Shared\Domain\Exception\DomainError;

final class ObstacleCollision extends DomainError
{
    private Obstacle $obstacle;
    private Coordinates $coordinates;

    public function __construct(Obstacle $obstacle, Coordinates $coordinates)
    {
        $this->obstacle = $obstacle;
        $this->coordinates = $coordinates;

        parent::__construct();
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