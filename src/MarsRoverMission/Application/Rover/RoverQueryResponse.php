<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover;

use MarsRoverMission\Domain\Rover\Rover;
use Shared\Domain\Bus\Query\QueryResponse;

final class RoverQueryResponse implements QueryResponse
{
    public function __construct(
        private array $point,
        private string $facingDirection
    ){}

    public static function fromRover(Rover $rover): self
    {
        return new self(
            [
                'x' => $rover->coordinates()->x()->value(),
                'y' => $rover->coordinates()->y()->value(),
            ],
            $rover->facingDirection()->value()
        );
    }

    public function getPoint(): array
    {
        return $this->point;
    }

    public function getFacingDirection(): string
    {
        return $this->facingDirection;
    }
}
