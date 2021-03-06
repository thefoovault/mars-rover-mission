<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Application\Map\Get;

use MarsRoverMission\Application\Map\Get\GetMapQuery;
use MarsRoverMission\Application\Map\Get\GetMapQueryHandler;
use MarsRoverMission\Application\Map\Get\GetMapService;
use MarsRoverMission\Application\Map\MapQueryResponse;
use MarsRoverMission\Domain\Map\Exception\MapNotFound;
use MarsRoverMission\Domain\Map\MapRepository;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeMap;

final class GetMapQueryHandlerTest extends TestCase
{
    private GetMapQueryHandler $getMapQueryHandler;
    private MapRepository $mapRepository;

    public function setUp(): void
    {
        $this->mapRepository = $this->createMock(MapRepository::class);
        $this->getMapQueryHandler = new GetMapQueryHandler(
            new GetMapService(
                $this->mapRepository
            )
        );
    }

    /** @test */
    public function shouldGetValidMap(): void
    {
        $map = FakeMap::create();

        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willReturn(
                $map
            );

        $mapResponse = $this->getMapQueryHandler->__invoke(
            new GetMapQuery()
        );
        $dimensions = $mapResponse->dimensions();

        $fakeMapResponse = MapQueryResponse::fromMap($map);
        $fakeDimensions = $fakeMapResponse->dimensions();

        $this->assertInstanceOf(MapQueryResponse::class, $mapResponse);
        $this->assertEquals($fakeDimensions['width'], $dimensions['width']);
        $this->assertEquals($fakeDimensions['height'], $dimensions['height']);
        $this->assertIsArray($mapResponse->obstacles());
    }

    /** @test */
    public function shouldThrowMapNotFoundException(): void
    {
        $this->expectException(MapNotFound::class);
        $this->mapRepository
            ->expects(self::once())
            ->method('find')
            ->willThrowException(new MapNotFound());

        $this->getMapQueryHandler->__invoke(
            new GetMapQuery()
        );
    }
}
