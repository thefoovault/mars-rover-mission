<?php

declare(strict_types=1);

namespace MarsRoverMission\Domain\Rover\Exception;

use MarsRoverMission\Domain\Rover\Instruction;
use Shared\Domain\Exception\DomainError;

final class InvalidInstruction extends DomainError
{
    private Instruction $instruction;

    public function __construct(Instruction $instruction)
    {
        $this->instruction = $instruction;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The instruction is invalid: <%s>',
            $this->instruction->value()
        );
    }
}
