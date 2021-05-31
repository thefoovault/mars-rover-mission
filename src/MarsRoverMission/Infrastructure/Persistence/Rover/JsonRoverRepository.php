<?php

declare(strict_types=1);

namespace MarsRoverMission\Infrastructure\Persistence\Rover;

use MarsRoverMission\Domain\Map\Position;
use MarsRoverMission\Domain\Rover\Coordinates;
use MarsRoverMission\Domain\Rover\Exception\RoverNotFound;
use MarsRoverMission\Domain\Rover\FacingDirection;
use MarsRoverMission\Domain\Rover\Rover;
use MarsRoverMission\Domain\Rover\RoverRepository;

final class JsonRoverRepository implements RoverRepository
{
    private const FILE = '../../../etc/data/rover.json';

    public function save(Rover $rover): void
    {
        file_put_contents(self::FILE, json_encode($this->extractRoverToArray($rover)));
    }

    private function extractRoverToArray(Rover $rover)
    {
        return [
            'coordinates' => [
                'x' => $rover->coordinates()->x()->value(),
                'y' => $rover->coordinates()->y()->value()
            ],
            'facingDirection' => $rover->facingDirection()->value()
        ];
    }

    public function find(): Rover
    {
        if (!file_exists(self::FILE)) {
            throw new RoverNotFound();
        }
        $roverInfo = json_decode(file_get_contents(self::FILE), true);

        return new Rover(
            new Coordinates(
                new Position($roverInfo['coordinates']['x']),
                new Position($roverInfo['coordinates']['y'])
            ),
            new FacingDirection($roverInfo['facingDirection'])
        );
    }
}
