<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Exception;

use Shared\Domain\Exception\DomainError;

class RoverNotFound extends DomainError
{
    public function errorMessage(): string
    {
        return 'Rover not found';
    }
}
