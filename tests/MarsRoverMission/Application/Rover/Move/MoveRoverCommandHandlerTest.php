<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application\Rover\Move;

use MarsRoverMission\Application\Map\Get\GetMapService;
use MarsRoverMission\Application\Rover\Get\GetRoverService;
use MarsRoverMission\Application\Rover\Move\MoveRoverCommand;
use MarsRoverMission\Application\Rover\Move\MoveRoverCommandHandler;
use MarsRoverMission\Application\Rover\Move\MoveRoverService;
use MarsRoverMission\Domain\Map\MapRepository;
use MarsRoverMission\Domain\Map\Service\CheckAvailablePositionService;
use MarsRoverMission\Domain\Rover\Exception\InvalidInstruction;
use MarsRoverMission\Domain\Rover\Exception\RoverMovementInterrupted;
use MarsRoverMission\Domain\Rover\RoverRepository;
use MarsRoverMission\Domain\Rover\Service\ExecuteMoveInstructionsService;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeMap;
use Test\MarsRoverMission\FakeRover;

class MoveRoverCommandHandlerTest extends TestCase
{
    private MoveRoverCommandHandler $commandHandler;
    private RoverRepository $roverRepository;
    private MapRepository $mapRepository;

    protected function setUp(): void
    {
        $this->roverRepository = $this->createMock(RoverRepository::class);
        $this->mapRepository = $this->createMock(MapRepository::class);

        $this->commandHandler = new MoveRoverCommandHandler(
            new MoveRoverService(
                new GetRoverService($this->roverRepository),
                new GetMapService($this->mapRepository),
                $this->roverRepository,
                new ExecuteMoveInstructionsService(
                    new CheckAvailablePositionService()
                )
            )
        );
    }

    /** @test */
    public function shouldMoveWithSimpleValidInstruction(): void
    {
        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeMap::create());

        $this->roverRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeRover::create());

        $this->commandHandler->__invoke(
            new MoveRoverCommand('F')
        );
    }

    /** @test */
    public function shouldMoveWithValidSetOfInstructions(): void
    {
        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeMap::create());

        $this->roverRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeRover::create());

        $this->commandHandler->__invoke(
            new MoveRoverCommand('FRFLFLF')
        );
    }

    /** @test */
    public function shouldThrowInvalidInstruction(): void
    {
        $this->expectException(InvalidInstruction::class);

        $this->commandHandler->__invoke(
            new MoveRoverCommand('A')
        );
    }

    /** @test */
    public function shouldThrowRoverMovementInterrupted(): void
    {
        $this->expectException(RoverMovementInterrupted::class);

        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeMap::create());

        $this->roverRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeRover::create());

        $this->commandHandler->__invoke(
            new MoveRoverCommand('FRFFLF')
        );
    }
}
