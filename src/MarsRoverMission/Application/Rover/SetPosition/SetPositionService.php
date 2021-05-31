<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\SetPosition;

use MarsRoverMission\Application\Map\Get\GetMapService;
use MarsRoverMission\Domain\Map\Service\CheckAvailablePositionService;
use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use MarsRoverMission\Domain\Rover\FacingDirection;
use MarsRoverMission\Domain\Rover\Rover;
use MarsRoverMission\Domain\Rover\RoverRepository;

final class SetPositionService
{
    public function __construct(
        private CheckAvailablePositionService $checkAvailablePositionService,
        private GetMapService $getMapService,
        private RoverRepository $roverRepository
    ) {}

    public function __invoke(Coordinates $coordinates, FacingDirection $facingDirection): void
    {
        $map = $this->getMapService->__invoke();
        $this->checkAvailablePositionService->check($map, $coordinates);

        $this->roverRepository->save(
            new Rover($coordinates, $facingDirection)
        );
    }
}
