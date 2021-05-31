<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

use MarsRoverMission\Domain\Rover\Exception\InvalidInstruction;
use Shared\Domain\ValueObject\StringValueObject;

final class Instruction extends StringValueObject
{
    private const FORWARD = 'F';
    private const RIGHT = 'R';
    private const LEFT = 'L';

    private const VALID_INSTRUCTIONS = [
        self::FORWARD => self::FORWARD,
        self::RIGHT => self::RIGHT,
        self::LEFT => self::LEFT
    ];

    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->assertValidInstruction($value);
    }

    private function assertValidInstruction(string $value): void
    {
        if (!isset(self::VALID_INSTRUCTIONS[$value])) {
            throw new InvalidInstruction($this);
        }
    }

    public function isMoveForward(): bool
    {
        return $this->value === self::FORWARD;
    }

    public function isMoveRight(): bool
    {
        return $this->value === self::RIGHT;
    }

    public function isMoveLeft(): bool
    {
        return $this->value === self::LEFT;
    }
}
