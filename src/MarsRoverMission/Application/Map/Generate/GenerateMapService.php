<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map\Generate;

use MarsRoverMission\Domain\TwoDimensionalPlane\Dimensions;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\MapRepository;
use MarsRoverMission\Domain\Map\Service\ObstacleGenerationService;

final class GenerateMapService
{
    public function __construct(
        private ObstacleGenerationService $obstacleGenerationService,
        private MapRepository $mapRepository
    ){}
    public function __invoke(Dimensions $dimensions): void
    {
        $obstacles = $this->obstacleGenerationService->generate($dimensions);

        $this->mapRepository->save(
            new Map($dimensions, $obstacles)
        );
    }
}
