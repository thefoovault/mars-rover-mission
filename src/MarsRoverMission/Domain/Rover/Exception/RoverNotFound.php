<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Exception;

use Shared\Domain\Exception\NotFoundException;

class RoverNotFound extends NotFoundException
{
    public function errorMessage(): string
    {
        return 'Rover not found';
    }
}
