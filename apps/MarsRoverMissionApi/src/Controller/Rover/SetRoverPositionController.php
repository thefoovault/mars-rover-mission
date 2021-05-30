<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Rover;

use MarsRoverMission\Application\Rover\SetPosition\SetPositionCommand;
use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SetRoverPositionController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $parameters = $this->getPayload($request);

        $this->dispatch(
            new SetPositionCommand(
                $parameters['x'],
                $parameters['y'],
                $parameters['facing-direction']
            )
        );

        return $this->createApiResponse('', Response::HTTP_CREATED);
    }
}
