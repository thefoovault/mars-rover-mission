<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover;

use MarsRoverMission\Domain\Rover\Rover;
use Shared\Domain\Bus\Query\QueryResponse;

final class RoverQueryResponse implements QueryResponse
{
    public function __construct(
        private int $xCoordinate,
        private int $yCoordinate,
        private string $facingDirection
    ){}

    public static function fromRover(Rover $rover): self
    {
        return new self(
            $rover->coordinates()->x()->value(),
            $rover->coordinates()->y()->value(),
            $rover->facingDirection()->value()
        );
    }

    public function getXCoordinate(): int
    {
        return $this->xCoordinate;
    }

    public function getYCoordinate(): int
    {
        return $this->yCoordinate;
    }

    public function getFacingDirection(): string
    {
        return $this->facingDirection;
    }
}
