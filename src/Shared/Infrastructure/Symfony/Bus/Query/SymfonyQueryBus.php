<?php

declare(strict_types=1);


namespace Shared\Infrastructure\Symfony\Bus\Query;

use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryBus;
use Shared\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $bus) {
        $this->messageBus = $bus;
    }

    public function ask(Query $query): ?Response
    {
        return $this->handle($query);
    }
}
