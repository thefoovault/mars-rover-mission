<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\SetPosition;

use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use MarsRoverMission\Domain\Rover\PointRover;
use MarsRoverMission\Domain\Rover\FacingDirection;
use Shared\Domain\Bus\Command\CommandHandler;

final class SetPositionCommandHandler implements CommandHandler
{
    public function __construct(
        private SetPositionService $setPositionService
    ){}

    public function __invoke(SetPositionCommand $setPositionCommand): void
    {
        $coordinates = new PointRover(
            new Coordinates($setPositionCommand->x()),
            new Coordinates($setPositionCommand->y())
        );

        $facingDirection = new FacingDirection($setPositionCommand->facingDirection());

        $this->setPositionService->__invoke($coordinates, $facingDirection);
    }
}
