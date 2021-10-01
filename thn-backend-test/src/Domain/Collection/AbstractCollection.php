<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Collection;

use ArrayObject;

abstract class AbstractCollection implements CollectionInterface
{
    /** @var ArrayObject */
    protected $items;

    private function __construct()
    {
        $this->items = new ArrayObject();
    }

    public static function create()
    {
        return new static();
    }

    public function getIterator()
    {
        return $this->items;
    }

    public function get(string $hash)
    {
        return $this->items[$hash] ?? null;
    }

    public function first()
    {
        return $this->items->getIterator()->current();
    }

    public function toArray(): array
    {
        return $this->getIterator()->getArrayCopy();
    }

    public function count(): int
    {
        return $this->items->count();
    }

    public function has($item): bool
    {
        return isset($this->items[$this->calculateHash($item)]);
    }

    public function removeItem($item): void
    {
        $items = $this->items->getArrayCopy();
        unset($items[$this->calculateHash($item)]);

        $this->items = new ArrayObject($items);
    }

    public function serialize(callable $function): array
    {
        return array_values(array_map($function, $this->toArray()));
    }

    public function filter(callable $fn): self
    {
        $this->reduce(function ($carry, $item) use ($fn) {
            if (true === $fn($item)) {
                $carry[] = $item;
            }

            return $carry;
        }, []);

        return $this;
    }

    public function reduce(callable $fn, $initial = []): self
    {
        $items = $this->items->getArrayCopy();
        $this->items = new ArrayObject();
        foreach (array_reduce($items, $fn, $initial) as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    public function map(callable $fn): self
    {
        $items = $this->items->getArrayCopy();
        $this->items = new ArrayObject();
        foreach (array_map($fn, $items) as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    public function remove(string $key)
    {
        $items = $this->items->getArrayCopy();
        unset($items[$key]);

        $this->items = new ArrayObject($items);
    }

    protected function addItem($item): self
    {
        $hash = $this->calculateHash($item);
        if (false === isset($this->items[$hash])) {
            $this->items[$hash] = $item;
        }

        return $this;
    }

    protected function doMerge(AbstractCollection $collection)
    {
        $mergedItems = array_merge(
            $this->items->getArrayCopy(),
            $collection->getIterator()->getArrayCopy()
        );

        unset($this->items);

        $this->items = new ArrayObject($mergedItems);

        return $this;
    }

    abstract protected function calculateHash($item): string;
}
