<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller\Rover;

use MarsRoverMission\Application\Rover\SetPosition\SetPositionCommand;
use MarsRoverMission\Domain\Map\Exception\MapNotFound;
use MarsRoverMission\Domain\Map\Exception\ObstacleCollision;
use MarsRoverMission\Domain\Map\Exception\PositionOutOfBounds;
use MarsRoverMission\Domain\Rover\Exception\InvalidFacingDirection;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SetRoverPositionController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $parameters = $this->getPayload($request);

        $this->dispatch(
            new SetPositionCommand(
                $parameters['point']['x'],
                $parameters['point']['y'],
                $parameters['facing-direction']
            )
        );

        return $this->createApiResponse(null, Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [
            ObstacleCollision::class => Response::HTTP_BAD_REQUEST,
            PositionOutOfBounds::class => Response::HTTP_BAD_REQUEST,
            InvalidFacingDirection::class => Response::HTTP_BAD_REQUEST,
            MapNotFound::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
