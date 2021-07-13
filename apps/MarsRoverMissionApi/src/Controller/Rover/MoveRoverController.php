<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Rover;

use MarsRoverMission\Application\Rover\Get\GetRoverQuery;
use MarsRoverMission\Application\Rover\Move\MoveRoverCommand;
use MarsRoverMission\Domain\Map\Exception\MapNotFound;
use MarsRoverMission\Domain\Rover\Exception\InvalidInstruction;
use MarsRoverMission\Domain\Rover\Exception\RoverMovementInterrupted;
use MarsRoverMission\Domain\Rover\Exception\RoverNotFound;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MoveRoverController extends ApiController
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

    protected function exceptions(): array
    {
        return [
            InvalidInstruction::class => Response::HTTP_BAD_REQUEST,
            RoverMovementInterrupted::class => Response::HTTP_BAD_REQUEST,
            RoverNotFound::class => Response::HTTP_NOT_FOUND,
            MapNotFound::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
