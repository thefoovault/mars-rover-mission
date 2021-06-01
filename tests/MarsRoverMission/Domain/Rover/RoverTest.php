<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Rover;

use MarsRoverMission\Domain\Rover\Rover;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeRover;

class RoverTest extends TestCase
{
    private Rover $fakeRover;

    protected function setUp(): void
    {
        $this->fakeRover = FakeRover::create();
    }

    /** @test */
    public function shouldCreateValidRover(): void
    {
        $this->assertEquals(FakeRover::X_COORDINATE, $this->fakeRover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $this->fakeRover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::FACING_DIRECTION, $this->fakeRover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingEast(): void
    {
        $this->fakeRover->moveRight();

        $this->assertEquals(FakeRover::X_COORDINATE, $this->fakeRover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $this->fakeRover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::EAST_DIRECTION, $this->fakeRover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingWest(): void
    {
        $this->fakeRover->moveLeft();

        $this->assertEquals(FakeRover::X_COORDINATE, $this->fakeRover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $this->fakeRover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::WEST_DIRECTION, $this->fakeRover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingSouth(): void
    {
        $this->fakeRover->moveLeft();
        $this->fakeRover->moveLeft();

        $this->assertEquals(FakeRover::X_COORDINATE, $this->fakeRover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $this->fakeRover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::SOUTH_DIRECTION, $this->fakeRover->facingDirection()->value());
    }

    /** @test */
    public function shouldMoveOnePositionToNorth(): void
    {
        $this->fakeRover->moveRight();
        $this->fakeRover->moveRight();
        $this->fakeRover->moveRight();
        $this->fakeRover->moveRight();

        $this->assertEquals(FakeRover::X_COORDINATE, $this->fakeRover->coordinates()->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE, $this->fakeRover->coordinates()->y()->value());
        $this->assertEquals(FakeRover::NORTH_DIRECTION, $this->fakeRover->facingDirection()->value());
    }

    /** @test */
    public function shouldReturnNextMovementCoordinates(): void
    {
        $coordinates = $this->fakeRover->nextCoordinateIWantToMove();

        $this->assertEquals(FakeRover::X_COORDINATE, $coordinates->x()->value());
        $this->assertEquals(FakeRover::Y_COORDINATE + 1, $coordinates->y()->value());
        $this->assertEquals(FakeRover::FACING_DIRECTION, $this->fakeRover->facingDirection()->value());
    }
}
