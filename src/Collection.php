<?php
declare(strict_types=1);

namespace ObjectCollection;

use ArrayAccess;
use Countable;
use Iterator;
use UnexpectedValueException;

/**
 * Class Collection
 * @package ObjectCollection
 */
abstract class Collection implements
    ArrayAccess,
    Countable,
    Iterator
{
    /**
     * @vat string|null Holds the allowed objects class name.
     */
    protected $allowed_item;

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var int
     */
    private $current = 0;

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->items[$this->current];
    }

    /**
     * @return int
     */
    public function next(): int
    {
        return $this->current++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->current;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->current]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->current = 0;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     * @throws UnexpectedValueException
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_string($this->allowed_item)) {
            throw new UnexpectedValueException();
        }

        if (is_a($value, $this->allowed_item)) {
            if (is_null($offset)) {
                $this->items[] = $value;
            } else {
                $this->items[$offset] = $value;
            }
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }
}