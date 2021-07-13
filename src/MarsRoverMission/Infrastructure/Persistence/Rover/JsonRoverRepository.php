<?php

declare(strict_types=1);

namespace MarsRoverMission\Infrastructure\Persistence\Rover;

use MarsRoverMission\Domain\TwoDimensionalPlane\Coordinates;
use MarsRoverMission\Domain\Rover\PointRover;
use MarsRoverMission\Domain\Rover\Exception\RoverNotFound;
use MarsRoverMission\Domain\Rover\FacingDirection;
use MarsRoverMission\Domain\Rover\Rover;
use MarsRoverMission\Domain\Rover\RoverRepository;
use Psr\Log\LoggerInterface;

final class JsonRoverRepository implements RoverRepository
{
    private const FILE = '../../../etc/data/rover.json';

    public function __construct(
        private LoggerInterface $logger
    ){}

    public function save(Rover $rover): void
    {
        $this->logger->info("User save the rover ");
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
        try {
            $this->logger->info("User wants to find get the rover data");
            if (!file_exists(self::FILE)) {
                throw new RoverNotFound();
            }
            $roverInfo = json_decode(file_get_contents(self::FILE), true);

            return new Rover(
                new PointRover(
                    new Coordinates($roverInfo['coordinates']['x']),
                    new Coordinates($roverInfo['coordinates']['y'])
                ),
                new FacingDirection($roverInfo['facingDirection'])
            );
        } catch (RoverNotFound $exception){
            $this->logger->error('Rover not found!', ['exception' => $exception]);
            throw $exception;
        }
    }
}
