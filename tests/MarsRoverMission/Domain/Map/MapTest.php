<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\Map\Obstacles;
use PHPUnit\Framework\TestCase;
use Test\MarsRoverMission\FakeMap;
use Traversable;

final class MapTest extends TestCase
{
    /** @test */
    public function shouldCreateValidMap(): void
    {
        $map = FakeMap::create();

        $this->assertEquals(10, $map->dimensions()->width()->value());
        $this->assertEquals(20, $map->dimensions()->height()->value());
        $this->assertInstanceOf(Obstacles::class, $map->obstacles());
        $this->assertInstanceOf(Traversable::class, $map->obstacles()->getIterator());
    }
}
