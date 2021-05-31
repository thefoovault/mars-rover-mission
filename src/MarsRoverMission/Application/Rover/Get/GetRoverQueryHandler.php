<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Rover\Get;

use MarsRoverMission\Application\Rover\RoverQueryResponse;
use Shared\Domain\Bus\Query\QueryHandler;

final class GetRoverQueryHandler implements QueryHandler
{
    public function __construct(
        private GetRoverService $getRoverService
    ){}

    public function __invoke(GetRoverQuery $getRoverQuery): RoverQueryResponse
    {
        $rover = $this->getRoverService->__invoke();

        return RoverQueryResponse::fromRover($rover);
    }
}
