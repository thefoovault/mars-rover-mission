<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Exception;

use Shared\Domain\Exception\DomainError;

final class MapNotFound extends DomainError
{
    public function errorMessage(): string
    {
        return 'Map not found';
    }
}
