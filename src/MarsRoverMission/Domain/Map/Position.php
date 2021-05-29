<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\Map\Exception\InvalidPosition;
use Shared\Domain\ValueObject\IntegerValueObject;

final class Position extends IntegerValueObject
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
}