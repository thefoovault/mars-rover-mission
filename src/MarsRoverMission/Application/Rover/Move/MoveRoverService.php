<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\Move;

use MarsRoverMission\Application\Map\Get\GetMapService;
use MarsRoverMission\Application\Rover\Get\GetRoverService;
use MarsRoverMission\Domain\Map\Service\CheckAvailablePositionService;
use MarsRoverMission\Domain\Rover\Exception\RoverMovementInterrupted;
use MarsRoverMission\Domain\Rover\Instruction;
use MarsRoverMission\Domain\Rover\Instructions;
use MarsRoverMission\Domain\Rover\RoverRepository;
use MarsRoverMission\Domain\Rover\Service\ExecuteMoveInstructionsService;
use Shared\Domain\Exception\DomainError;

final class MoveRoverService
{
    public function __construct(
        private GetRoverService $getRoverService,
        private GetMapService $getMapService,
        private RoverRepository $roverRepository,
        private ExecuteMoveInstructionsService $executeMoveInstructionsService
    ){}

    public function __invoke(Instructions $instructions): void
    {
        $rover = $this->getRoverService->__invoke();
        $map = $this->getMapService->__invoke();

        try {
            /** @var Instruction $instruction */
            foreach ($instructions as $instruction) {
                $rover = $this->executeMoveInstructionsService->move($instruction, $rover, $map);
            }
        } catch (DomainError) {
            $this->roverRepository->save($rover);
            throw new RoverMovementInterrupted($rover);
        }

        $this->roverRepository->save($rover);
    }
}

