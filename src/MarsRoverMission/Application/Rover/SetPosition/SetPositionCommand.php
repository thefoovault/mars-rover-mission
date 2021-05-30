<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\SetPosition;

use Shared\Domain\Bus\Command\Command;

final class SetPositionCommand implements Command
{
    public function __construct(
        private int $x,
        private int $y,
        private string $facingDirection
    ){}

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function facingDirection(): string
    {
        return $this->facingDirection;
    }
}
