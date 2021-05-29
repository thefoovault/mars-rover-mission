<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map\Generate;

use MarsRoverMission\Domain\Map\Dimensions;
use MarsRoverMission\Domain\Map\Height;
use MarsRoverMission\Domain\Map\Width;
use Shared\Domain\Bus\Command\CommandHandler;

final class GenerateMapCommandHandler implements CommandHandler
{
    public function __construct(
        private GenerateMapService $service
    ){}

    public function __invoke(GenerateMapCommand $generateMapCommand): void
    {
        $dimensions = new Dimensions(
            new Width($generateMapCommand->width()),
            new Height($generateMapCommand->height())
        );

        $this->service->__invoke($dimensions);
    }
}
