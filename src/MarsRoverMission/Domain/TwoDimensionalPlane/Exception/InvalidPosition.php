<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\TwoDimensionalPlane\Exception;

use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use Shared\Domain\Exception\InvalidDataException;

final class InvalidPosition extends InvalidDataException
{
    private Coordinates $position;

    public function __construct(Coordinates $position)
    {
        $this->position = $position;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The position is invalid: <%s>',
            $this->position->value()
        );
    }
}
