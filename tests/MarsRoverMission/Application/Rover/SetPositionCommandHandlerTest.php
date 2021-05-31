<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application\Rover;

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
                0,
                0,
                'N'
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
                20,
                0,
                'N'
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
                2,
                2,
                'N'
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
                0,
                0,
                'A'
            )
        );
    }
}
