<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Map;

use MarsRoverMission\Application\Map\Get\GetMapQuery;
use MarsRoverMission\Domain\Map\Exception\MapNotFound;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class GetMapController extends ApiController
{
    public function __invoke(): Response
    {
        $map = $this->ask(
            new GetMapQuery()
        );

        return $this->createApiResponse($map);
    }

    protected function exceptions(): array
    {
        return [
            MapNotFound::class => Response::HTTP_NOT_FOUND
        ];
    }
}
