<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\Move;

use MarsRoverMission\Domain\Rover\Instructions;
use Shared\Domain\Bus\Command\CommandHandler;

final class MoveRoverCommandHandler implements CommandHandler
{
    public function __construct(
        private MoveRoverService $moveRoverService
    ){}

    public function __invoke(MoveRoverCommand $moveRoverCommand): void
    {
        $instructions = Instructions::fromString($moveRoverCommand->instructions());
        $this->moveRoverService->__invoke($instructions);
    }
}
