<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\SetPosition;

use MarsRoverMission\Domain\Map\Position;
use MarsRoverMission\Domain\Rover\Coordinates;
use MarsRoverMission\Domain\Rover\FacingDirection;
use Shared\Domain\Bus\Command\CommandHandler;

final class SetPositionCommandHandler implements CommandHandler
{
    public function __construct(
        private SetPositionService $setPositionService
    ){}

    public function __invoke(SetPositionCommand $setPositionCommand): void
    {
        $coordinates = new Coordinates(
            new Position($setPositionCommand->x()),
            new Position($setPositionCommand->y())
        );

        $facingDirection = new FacingDirection($setPositionCommand->facingDirection());

        $this->setPositionService->__invoke($coordinates, $facingDirection);
    }
}
