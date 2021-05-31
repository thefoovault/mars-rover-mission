<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Service;

use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\Service\CheckAvailablePositionService;
use MarsRoverMission\Domain\Rover\Instruction;
use MarsRoverMission\Domain\Rover\Rover;

final class ExecuteMoveInstructionsService
{
    public function __construct(
        private CheckAvailablePositionService $checkAvailablePositionService
    ){}
    public function move(Instruction $instruction, Rover $rover, Map $map): Rover
    {
        if ($instruction->isMoveForward()) {
            $this->checkAvailablePositionService->check($map, $rover->nextCoordinateIWantToMove());
            $rover->moveForward();
        } elseif ($instruction->isMoveLeft()) {
            $rover->moveLeft();
        } elseif ($instruction->isMoveRight()) {
            $rover->moveRight();
        }

        return $rover;
    }
}
