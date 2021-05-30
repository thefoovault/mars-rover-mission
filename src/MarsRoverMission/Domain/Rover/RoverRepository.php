<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

interface RoverRepository
{
    public function save(Rover $rover): void;
}
