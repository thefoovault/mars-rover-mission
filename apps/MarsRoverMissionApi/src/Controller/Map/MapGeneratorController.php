<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Map;

use MarsRoverMission\Application\Map\Generate\GenerateMapCommand;
use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MapGeneratorController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $parameters = $this->getPayload($request);

        $this->dispatch(
            new GenerateMapCommand(
                $parameters['width'],
                $parameters['height']
            )
        );

        return $this->createApiResponse(null, Response::HTTP_CREATED);
    }
}
