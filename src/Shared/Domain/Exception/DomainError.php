<?php

declare(strict_types=1);

namespace Shared\Domain\Exception;

use DomainException;

abstract class DomainError extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    abstract public function errorCode(): string;

    abstract public function errorMessage(): string;
}
