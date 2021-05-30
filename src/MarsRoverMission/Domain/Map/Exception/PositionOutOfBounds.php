<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Exception;

use MarsRoverMission\Domain\Rover\Coordinates;
use Shared\Domain\Exception\DomainError;

final class PositionOutOfBounds extends DomainError
{
    private Coordinates $coordinates;

    public function __construct(Coordinates $coordinates)
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
