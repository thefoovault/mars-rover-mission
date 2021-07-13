<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Map;

use MarsRoverMission\Application\Map\Generate\GenerateMapCommand;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MapGeneratorController extends ApiController
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

    protected function exceptions(): array
    {
        return [];
    }
}
