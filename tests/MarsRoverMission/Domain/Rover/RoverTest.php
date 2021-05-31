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

        $this->assertEquals(0, $rover->coordinates()->x()->value());
        $this->assertEquals(0, $rover->coordinates()->y()->value());
        $this->assertEquals('N', $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingEast(): void
    {
        $rover = FakeRover::create();
        $rover->moveRight();

        $this->assertEquals(0, $rover->coordinates()->x()->value());
        $this->assertEquals(0, $rover->coordinates()->y()->value());
        $this->assertEquals('E', $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingWest(): void
    {
        $rover = FakeRover::create();
        $rover->moveLeft();

        $this->assertEquals(0, $rover->coordinates()->x()->value());
        $this->assertEquals(0, $rover->coordinates()->y()->value());
        $this->assertEquals('W', $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldBeFacingSouth(): void
    {
        $rover = FakeRover::create();
        $rover->moveLeft();
        $rover->moveLeft();

        $this->assertEquals(0, $rover->coordinates()->x()->value());
        $this->assertEquals(0, $rover->coordinates()->y()->value());
        $this->assertEquals('S', $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldMoveOnePositionToNorth(): void
    {
        $rover = FakeRover::create();
        $rover->moveRight();
        $rover->moveRight();
        $rover->moveRight();
        $rover->moveRight();

        $this->assertEquals(0, $rover->coordinates()->x()->value());
        $this->assertEquals(0, $rover->coordinates()->y()->value());
        $this->assertEquals('N', $rover->facingDirection()->value());
    }

    /** @test */
    public function shouldReturnNextMovementCoordinates(): void
    {
        $rover = FakeRover::create();
        $coordinates = $rover->nextCoordinateIWantToMove();

        $this->assertEquals(0, $coordinates->x()->value());
        $this->assertEquals(1, $coordinates->y()->value());
    }
}
