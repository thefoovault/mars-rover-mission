<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Exception;

use MarsRoverMission\Domain\Rover\FacingDirection;
use Shared\Domain\Exception\InvalidDataException;

final class InvalidFacingDirection extends InvalidDataException
{
    private FacingDirection $facingDirection;

    public function __construct(FacingDirection $facingDirection)
    {
        $this->facingDirection = $facingDirection;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The facing direction is invalid: <%s>',
            $this->facingDirection->value()
        );
    }
}
