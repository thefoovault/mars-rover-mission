<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application\Map\Generate;

use MarsRoverMission\Application\Map\Generate\GenerateMapCommand;
use MarsRoverMission\Application\Map\Generate\GenerateMapCommandHandler;
use MarsRoverMission\Application\Map\Generate\GenerateMapService;
use MarsRoverMission\Domain\Map\MapRepository;
use MarsRoverMission\Domain\Map\Service\ObstacleGenerationService;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeMap;

final class GenerateMapCommandHandlerTest extends TestCase
{
    private GenerateMapCommandHandler $commandHandler;
    private MapRepository $mapRepository;

    protected function setUp(): void
    {
        $this->mapRepository = $this->createMock(MapRepository::class);
        $this->commandHandler = new GenerateMapCommandHandler(
            new GenerateMapService(
                new ObstacleGenerationService(),
                $this->mapRepository
            )
        );
    }

    /** @test */
    public function shouldGenerateMap(): void
    {
        $this->mapRepository
            ->expects(self::once())
            ->method('save');

        $this->commandHandler->__invoke(
            new GenerateMapCommand(
                FakeMap::WIDTH,
                FakeMap::HEIGHT
            )
        );
    }
}
