<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Exception;

use MarsRoverMission\Domain\Rover\PointRover;
use Shared\Domain\Exception\InvalidDataException;

final class PositionOutOfBounds extends InvalidDataException
{
    private PointRover $coordinates;

    public function __construct(PointRover $coordinates)
    {
        $this->coordinates = $coordinates;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The point is out of the map: (%s, %s)',
            $this->coordinates->x()->value(),
            $this->coordinates->y()->value()
        );
    }
}
