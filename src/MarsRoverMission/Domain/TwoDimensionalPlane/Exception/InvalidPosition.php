<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\TwoDimensionalPlane\Exception;

use MarsRoverMission\Domain\TwoDimensionalPlane\Position;
use Shared\Domain\Exception\DomainError;

final class InvalidPosition extends DomainError
{
    private Position $position;

    public function __construct(Position $position)
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
