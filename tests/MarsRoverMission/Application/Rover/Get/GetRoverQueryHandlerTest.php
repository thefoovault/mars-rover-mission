<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application\Rover\Get;

use MarsRoverMission\Application\Rover\Get\GetRoverQuery;
use MarsRoverMission\Application\Rover\Get\GetRoverQueryHandler;
use MarsRoverMission\Application\Rover\Get\GetRoverService;
use MarsRoverMission\Application\Rover\RoverQueryResponse;
use MarsRoverMission\Domain\Rover\Exception\RoverNotFound;
use MarsRoverMission\Domain\Rover\RoverRepository;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeRover;

final class GetRoverQueryHandlerTest extends TestCase
{
    private GetRoverQueryHandler $getRoverQueryHandler;
    private RoverRepository $roverRepository;

    public function setUp(): void
    {
        $this->roverRepository = $this->createMock(RoverRepository::class);

        $this->getRoverQueryHandler = new GetRoverQueryHandler(
            new GetRoverService(
                $this->roverRepository
            )
        );
    }

    /** @test */
    public function shouldGetValidRover(): void
    {
        $rover = FakeRover::create();

        $this->roverRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(
                $rover
            );

        $queryResponse = $this->getRoverQueryHandler->__invoke(
            new GetRoverQuery()
        );

        $fakeQueryResponse = RoverQueryResponse::fromRover($rover);

        $this->assertInstanceOf(RoverQueryResponse::class, $queryResponse);
        $this->assertEquals($fakeQueryResponse->getXCoordinate(), $queryResponse->getXCoordinate());
        $this->assertEquals($fakeQueryResponse->getYCoordinate(), $queryResponse->getYCoordinate());
        $this->assertEquals($fakeQueryResponse->getFacingDirection(), $queryResponse->getFacingDirection());
    }

    /** @test */
    public function shouldThrowMapNotFoundException(): void
    {
        $this->expectException(RoverNotFound::class);
        $this->roverRepository
            ->expects(self::once())
            ->method('find')
            ->willThrowException(new RoverNotFound());

        $this->getRoverQueryHandler->__invoke(
            new GetRoverQuery()
        );
    }
}
