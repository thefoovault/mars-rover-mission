<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Exception;

use MarsRoverMission\Domain\Rover\Rover;
use Shared\Domain\Exception\DomainError;

final class RoverMovementInterrupted extends DomainError
{
    public Rover $rover;

    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The Rover movement has been interrupted. Finished at position (%s, %s) and facing direction %s.',
            $this->rover->coordinates()->x()->value(),
            $this->rover->coordinates()->y()->value(),
            $this->rover->facingDirection()->value()
        );
    }
}
