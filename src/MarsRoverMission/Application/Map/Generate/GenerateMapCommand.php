<?php

declare(strict_types=1);

namespace MarsRoverMission\Application\Map\Generate;

use Shared\Domain\Bus\Command\Command;

final class GenerateMapCommand implements Command
{
    public function __construct(
        private int $width,
        private int $height
    ){}

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }
}
