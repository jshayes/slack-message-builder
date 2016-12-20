<?php

namespace JSHayes\SlackMessageBuilder;

use JsonSerializable;
use InvalidArgumentException;
use Illuminate\Support\Collection;

abstract class AttributeCollection implements JsonSerializable
{
    private $attributes;

    /**
     * Get the collection of attributes for this AttributeCollection
     *
     * @return \Illuminate\Support\Collection
     *         The collection of attributes
     */
    private function getAttributes(): Collection
    {
        if (is_null($this->attributes)) {
            $this->attributes = new Collection();
        }

        return $this->attributes;
    }

    /**
     * Puts a single key-value item to the AttributeCollection. If the item already
     * exists, then it is replaced with the new value
     *
     * @param string $key
     *        The attribute key
     * @param mixed $value
     *        The value to set
     *
     * @return void
     */
    protected function putItem(string $key, $value)
    {
        $existingValue = $this->getAttributes()->get($key);

        if ($existingValue instanceof Collection) {
            throw new InvalidArgumentException('Tried to put an item to a collection.');
        }

        $this->getAttributes()->put($key, $value);
    }

    /**
     * Append an item to the item collection identified by the key
     *
     * @throws \InvalidArgumentException
     *         Thrown when the attribute associated with the key is not a collection
     *
     * @param string $key
     *        The attribute key
     * @param mixed $value
     *        The value to append
     *
     * @return void
     */
    protected function appendItem(string $key, $value)
    {
        if (!$this->getAttributes()->has($key)) {
            $this->getAttributes()->put($key, new Collection());
        }

        $existingValue = $this->getAttributes()->get($key);

        if (!$existingValue instanceof Collection) {
            throw new InvalidArgumentException('Tried to append an item to a non collection.');
        }

        $this->getAttributes()->get($key)->push($value);
    }

    /**
     * Convert this attribute collection into an array that can be json encoded
     *
     * @return array
     *         The json encodable array
     */
    public function jsonSerialize(): array
    {
        return $this->getAttributes()->jsonSerialize();
    }

    /**
     * Convert this attribute collection into a string
     *
     * @return string
     *         The string representation of this attribute collection
     */
    public function __toString(): string
    {
        return json_encode($this);
    }
}
