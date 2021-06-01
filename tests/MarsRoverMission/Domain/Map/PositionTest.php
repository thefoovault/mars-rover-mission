<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\TwoDimensionalPlane\Exception\InvalidPosition;
use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use PHPUnit\Framework\TestCase;

final class PositionTest extends TestCase
{
    /** @test */
    public function shouldCreateValidPosition(): void
    {
        $position = new Coordinates(10);
        $this->assertEquals(10, $position->value());
    }

    /** @test */
    public function shouldThrowInvalidPositionException(): void
    {
        $this->expectException(InvalidPosition::class);
        $this->expectExceptionMessage('The position is invalid: <-1>');
        new Coordinates(-1);
    }
}
