<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony\Bus\Command;

use Shared\Domain\Bus\Command\Command;
use Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class SymfonyCommandBus implements CommandBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $bus) {
        $this->messageBus = $bus;
    }

    public function dispatch(Command $command): void
    {
        $this->handle($command);
    }
}
