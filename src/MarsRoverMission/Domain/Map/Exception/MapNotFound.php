<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Map\Exception;

use Shared\Domain\Exception\NotFoundException;

final class MapNotFound extends NotFoundException
{
    public function errorCode(): string
    {
        return 'map_not_found';
    }

    public function errorMessage(): string
    {
        return 'Map not found';
    }
}
