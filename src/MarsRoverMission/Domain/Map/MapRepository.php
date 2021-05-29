<?php

declare(strict_types=1);


namespace MarsRoverMission\Domain\Map;


interface MapRepository
{
    public function save(Map $map): void;
}
