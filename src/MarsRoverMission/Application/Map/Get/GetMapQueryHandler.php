<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map\Get;

use MarsRoverMission\Application\Map\MapQueryResponse;
use Shared\Domain\Bus\Query\QueryHandler;

final class GetMapQueryHandler implements QueryHandler
{
    public function __construct(
        private GetMapService $getMapService
    ){}

    public function __invoke(GetMapQuery $getMapQuery): MapQueryResponse
    {
        $map = $this->getMapService->__invoke();

        return MapQueryResponse::fromMap($map);
    }
}
