<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover;

use Shared\Domain\Collection;

final class Instructions extends Collection
{
    public static function fromString(string $value): self
    {
        $instructions = self::convertStringToArray($value);

        return new self(self::createInstructions($instructions));
    }

    private static function convertStringToArray(string $instructions): array
    {
        return str_split($instructions);
    }

    private static function createInstructions(array $instructionsArray): array
    {
        $instructions = [];
        foreach ($instructionsArray as $instruction) {
            $instructions[] = new Instruction($instruction);
        }

        return $instructions;
    }

    protected function type(): string
    {
        return Instruction::class;
    }
}
