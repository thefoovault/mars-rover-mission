<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\Move;

use Shared\Domain\Bus\Command\Command;

final class MoveRoverCommand implements Command
{
    public function __construct(
        private string $instructions
    ){}

    public function instructions(): string
    {
        return $this->instructions;
    }
}
