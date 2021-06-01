<?php

declare(strict_types=1);

namespace Test\MarsRoverMission\Domain\Map;

use MarsRoverMission\Domain\Map\Obstacle;
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
        $iterator = $map->obstacles()->getIterator();
        $obstacle = $iterator->current();

        $this->assertEquals(FakeMap::WIDTH, $map->dimensions()->width()->value());
        $this->assertEquals(FakeMap::HEIGHT, $map->dimensions()->height()->value());
        $this->assertInstanceOf(Obstacles::class, $map->obstacles());
        $this->assertInstanceOf(Traversable::class, $iterator);
        $this->assertInstanceOf(Obstacle::class, $obstacle);
        $this->assertEquals(FakeMap::X_COORDINATE, $obstacle->x()->value());
        $this->assertEquals(FakeMap::Y_COORDINATE, $obstacle->y()->value());
    }
}
