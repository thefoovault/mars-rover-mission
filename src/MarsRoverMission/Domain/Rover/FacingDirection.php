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

    public function isNorth(): bool
    {
        return $this->value() === self::NORTH;
    }

    public function isSouth(): bool
    {
        return $this->value() === self::SOUTH;
    }

    public function isEast(): bool
    {
        return $this->value() === self::EAST;
    }

    public function isWest(): bool
    {
        return $this->value() === self::WEST;
    }

    public function leftFacingDirection(): self
    {
        $newFacingDirection = match ($this->value) {
            self::NORTH => self::WEST,
            self::WEST => self::SOUTH,
            self::SOUTH => self::EAST,
            self::EAST => self::NORTH
        };

        return new self($newFacingDirection);
    }

    public function rightFacingDirection(): self
    {
        $newFacingDirection = match ($this->value) {
            self::NORTH => self::EAST,
            self::EAST => self::SOUTH,
            self::SOUTH => self::WEST,
            self::WEST => self::NORTH
        };

        return new self($newFacingDirection);
    }
}
