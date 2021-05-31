<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Rover;

use MarsRoverMission\Application\Rover\Get\GetRoverQuery;
use MarsRoverMission\Application\Rover\Move\MoveRoverCommand;
use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MoveRoverController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $parameters = $this->getPayload($request);

        $this->dispatch(
            new MoveRoverCommand($parameters['instructions'])
        );

        $rover = $this->ask(
            new GetRoverQuery()
        );

        return $this->createApiResponse($rover, Response::HTTP_CREATED);
    }
}
