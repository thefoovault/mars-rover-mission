<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\Map\Dimensions;
use MarsRoverMission\Domain\Map\Height;
use MarsRoverMission\Domain\Map\Map;
use MarsRoverMission\Domain\Map\Obstacles;
use MarsRoverMission\Domain\Map\Width;
use PHPUnit\Framework\TestCase;
use Traversable;

final class MapTest extends TestCase
{
    /** @test */
    public function shouldCreateValidMap(): void
    {
        $map = new Map(
            new Dimensions(
                new Width(10),
                new Height(20)
            ),
            new Obstacles([])
        );

        $this->assertEquals(10, $map->dimensions()->width()->value());
        $this->assertEquals(20, $map->dimensions()->height()->value());
        $this->assertInstanceOf(Obstacles::class, $map->obstacles());
        $this->assertInstanceOf(Traversable::class, $map->obstacles()->getIterator());
    }
}
