<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\TwoDimensionalPlane\Exception;

use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use Shared\Domain\Exception\InvalidDataException;

final class InvalidCoordinates extends InvalidDataException
{
    private Coordinates $coordinates;

    public function __construct(Coordinates $coordinates)
    {
        $this->coordinates = $coordinates;
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_coordinates';
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The position is invalid: <%s>',
            $this->coordinates->value()
        );
    }
}
