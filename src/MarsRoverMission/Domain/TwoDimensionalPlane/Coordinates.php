<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\TwoDimensionalPlane;

use MarsRoverMission\Domain\TwoDimensionalPlane\Exception\InvalidPosition;
use Shared\Domain\ValueObject\IntegerValueObject;

final class Coordinates extends IntegerValueObject
{
    public function __construct(int $value)
    {
        parent::__construct($value);
        $this->assertValidPosition($value);
    }

    private function assertValidPosition(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPosition($this);
        }
    }

    public function sumPosition(int $diff): self
    {
        return new self($this->value() + $diff);
    }
}
