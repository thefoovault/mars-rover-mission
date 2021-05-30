<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Map;

use MarsRoverMission\Application\Map\Get\GetMapQuery;
use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

final class GetMapController extends Controller
{
    public function __invoke(): Response
    {
        $map = $this->ask(
            new GetMapQuery()
        );

        return $this->createApiResponse($map);
    }
}
