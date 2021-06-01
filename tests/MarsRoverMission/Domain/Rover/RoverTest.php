<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Rover;

use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeRover;

class RoverTest extends TestCase
{
    /** @test */
    public function shouldCreateValidRover(): void
    {
        $rover = FakeRover::create();

        $this->assertEquals(FakeRover::X_COORDINATE, $rover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $rover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::FACING_DIRECTION, $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingEast(): void
    {
        $rover = FakeRover::create();
        $rover->moveRight();

        $this->assertEquals(FakeRover::X_COORDINATE, $rover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $rover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::EAST_DIRECTION, $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingWest(): void
    {
        $rover = FakeRover::create();
        $rover->moveLeft();

        $this->assertEquals(FakeRover::X_COORDINATE, $rover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $rover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::WEST_DIRECTION, $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingSouth(): void
    {
        $rover = FakeRover::create();
        $rover->moveLeft();
        $rover->moveLeft();

        $this->assertEquals(FakeRover::X_COORDINATE, $rover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $rover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::SOUTH_DIRECTION, $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldMoveOnePositionToNorth(): void
    {
        $rover = FakeRover::create();
        $rover->moveRight();
        $rover->moveRight();
        $rover->moveRight();
        $rover->moveRight();

        $this->assertEquals(FakeRover::X_COORDINATE, $rover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $rover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::NORTH_DIRECTION, $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldReturnNextMovementCoordinates(): void
    {
        $rover = FakeRover::create();
        $coordinates = $rover->nextCoordinateIWantToMove();

        $this->assertEquals(FakeRover::X_COORDINATE, $coordinates->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE + 1, $coordinates->y()->value());
        $this->assertEquals(FakeRover::FACING_DIRECTION, $rover->facingDirection()->value());
    }
}
