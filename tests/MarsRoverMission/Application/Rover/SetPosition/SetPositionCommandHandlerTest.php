<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application\SetPosition;

use MarsRoverMission\Application\Map\Get\GetMapService;
use MarsRoverMission\Application\Rover\SetPosition\SetPositionCommand;
use MarsRoverMission\Application\Rover\SetPosition\SetPositionCommandHandler;
use MarsRoverMission\Application\Rover\SetPosition\SetPositionService;
use MarsRoverMission\Domain\Map\Exception\ObstacleCollision;
use MarsRoverMission\Domain\Map\Exception\PositionOutOfBounds;
use MarsRoverMission\Domain\Map\MapRepository;
use MarsRoverMission\Domain\Map\Service\CheckAvailablePositionService;
use MarsRoverMission\Domain\Rover\Exception\InvalidFacingDirection;
use MarsRoverMission\Domain\Rover\RoverRepository;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeMap;
use Test\MarsRoverMission\FakeRover;

final class SetPositionCommandHandlerTest extends TestCase
{
    private SetPositionCommandHandler $commandHandler;
    private RoverRepository $roverRepository;
    private MapRepository $mapRepository;

    protected function setUp(): void
    {
        $this->roverRepository = $this->createMock(RoverRepository::class);
        $this->mapRepository = $this->createMock(MapRepository::class);

        $this->commandHandler = new SetPositionCommandHandler(
            new SetPositionService(
                new CheckAvailablePositionService(),
                new GetMapService($this->mapRepository),
                $this->roverRepository
            )
        );
    }

    /** @test */
    public function shouldCreateValidRover(): void
    {
        $this->roverRepository
            ->expects(self::once())
            ->method('save');

        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeMap::create());

        $this->commandHandler->__invoke(
            new SetPositionCommand(
                FakeRover::X_COORDINATE,
                FakeRover::Y_COORDINATE,
            FakeRover::FACING_DIRECTION
            )
        );
    }

    /** @test */
    public function shouldThrowPositionOutOfBoundsException(): void
    {
        $this->expectException(PositionOutOfBounds::class);

        $this->roverRepository
            ->expects(self::never())
            ->method('save');

        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeMap::create());

        $this->commandHandler->__invoke(
            new SetPositionCommand(
                FakeMap::WIDTH + 10,
                FakeRover::Y_COORDINATE,
                FakeRover::FACING_DIRECTION
            )
        );
    }

    /** @test */
    public function shouldThrowObstacleCollisionException(): void
    {
        $this->expectException(ObstacleCollision::class);

        $this->roverRepository
            ->expects(self::never())
            ->method('save');

        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(FakeMap::create());

        $this->commandHandler->__invoke(
            new SetPositionCommand(
                FakeMap::OBSTACLE_X_COORDINATE,
                FakeMap::OBSTACLE_Y_COORDINATE,
                FakeRover::FACING_DIRECTION
            )
        );
    }

    /** @test */
    public function shouldThrowInvalidFacingDirectionException(): void
    {
        $this->expectException(InvalidFacingDirection::class);

        $this->roverRepository
            ->expects(self::never())
            ->method('save');

        $this->mapRepository
            ->expects(self::never())
            ->method('find');

        $this->commandHandler->__invoke(
            new SetPositionCommand(
                FakeRover::X_COORDINATE,
                FakeRover::Y_COORDINATE,
                'A'
            )
        );
    }
}
