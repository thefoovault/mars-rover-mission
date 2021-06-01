<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover;

use JsonSerializable;
use MarsRoverMission\Domain\Rover\Rover;
use Shared\Domain\Bus\Query\QueryResponse;

final class RoverQueryResponse implements QueryResponse, JsonSerializable
{
    private const POINT = 'point';
    private const X_COORDINATE = 'x';
    private const Y_COORDINATE = 'y';
    private const FACING_DIRECTION = 'facingDirection';

    public function __construct(
        private array $point,
        private string $facingDirection
    ){}

    public static function fromRover(Rover $rover): self
    {
        return new self(
            [
                self::X_COORDINATE => $rover->coordinates()->x()->value(),
                self::Y_COORDINATE => $rover->coordinates()->y()->value(),
            ],
            $rover->facingDirection()->value()
        );
    }

    public function point(): array
    {
        return $this->point;
    }

    public function facingDirection(): string
    {
        return $this->facingDirection;
    }

    public function jsonSerialize(): array
    {
        return [
            self::POINT => [
                self::X_COORDINATE => $this->point()[self::X_COORDINATE],
                self::Y_COORDINATE => $this->point()[self::Y_COORDINATE]
            ],
            self::FACING_DIRECTION => $this->facingDirection()
        ];
    }
}
