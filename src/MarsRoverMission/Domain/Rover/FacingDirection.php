<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

use MarsRoverMission\Domain\Rover\Exception\InvalidFacingDirection;
use Shared\Domain\ValueObject\StringValueObject;

final class FacingDirection extends StringValueObject
{
    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST = 'E';
    private const WEST = 'W';

    private const VALID_DIRECTIONS = [
        self::NORTH => self::NORTH,
        self::SOUTH => self::SOUTH,
        self::EAST => self::EAST,
        self::WEST => self::WEST
    ];

    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->assertValidFacingDirection($value);
    }

    private function assertValidFacingDirection(string $value): void
    {
        if (!isset(self::VALID_DIRECTIONS[$value])) {
            throw new InvalidFacingDirection($this);
        }
    }
}
