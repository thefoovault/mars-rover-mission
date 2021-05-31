<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\Get;

use MarsRoverMission\Domain\Rover\Rover;
use MarsRoverMission\Domain\Rover\RoverRepository;

final class GetRoverService
{
    public function __construct(
        private RoverRepository $roverRepository
    ){}

    public function __invoke(): Rover
    {
        return $this->roverRepository->find();
    }
}
