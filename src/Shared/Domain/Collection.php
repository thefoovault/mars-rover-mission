<?php

declare(strict_types=1);

namespace Shared\Domain;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

abstract class Collection implements Countable, IteratorAggregate
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->assertItemsHasSameType($items);
        $this->items = $items;
    }

    abstract protected function type(): string;

    public function add(mixed $item): void
    {
        $this->assertItemHasSameType($item);
        $this->items[] = $item;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    private function assertItemsHasSameType(array $items): void
    {
        foreach ($items as $item) {
            $this->assertItemHasSameType($item);
        }
    }

    private function assertItemHasSameType(mixed $item): void
    {
        $expected_class = $this->type();

        if (!$item instanceof $expected_class) {
            throw new InvalidArgumentException(
                sprintf(
                    'The item should be an instance of %s',
                    $expected_class
                )
            );
        }
    }
}
