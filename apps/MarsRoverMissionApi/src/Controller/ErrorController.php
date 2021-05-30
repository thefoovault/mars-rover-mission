<?php

declare(strict_types=1);

namespace MarsRoverMissionApi\Controller;

use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends Controller
{
    /**
     * @ErrorMapping
     */
    public function __invoke(FlattenException $exception): Response
    {
        return $this->createApiResponse(
            $exception->getMessage(),
            $exception->getStatusCode()
        );
    }
}
