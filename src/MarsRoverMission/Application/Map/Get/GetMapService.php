<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map\Get;

use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\MapRepository;

final class GetMapService
{
    public function __construct(
        private MapRepository $mapRepository
    ){}

    public function __invoke(): Map
    {
        return $this->mapRepository->find();
    }
}
