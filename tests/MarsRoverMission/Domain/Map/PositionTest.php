<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\Map\Exception\InvalidPosition;
use MarsRoverMission\Domain\Map\Position;
use PHPUnit\Framework\TestCase;

final class PositionTest extends TestCase
{
    /** @test */
    public function shouldCreateValidPosition(): void
    {
        $position = new Position(10);
        $this->assertEquals(10, $position->value());
    }

    /** @test */
    public function shouldThrowInvalidPositionException(): void
    {
        $this->expectException(InvalidPosition::class);
        $this->expectExceptionMessage('The position is invalid: <-1>');
        new Position(-1);
    }
}
