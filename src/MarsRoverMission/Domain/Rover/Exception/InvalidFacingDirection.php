<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Exception;

use MarsRoverMission\Domain\Rover\FacingDirection;
use Shared\Domain\Exception\DomainError;

final class InvalidFacingDirection extends DomainError
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
