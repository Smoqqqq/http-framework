<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\ParameterBag;

class ParameterBag
{
    public function __construct(private array $params = [])
    {
    }

    /**
     * Gets the value associated with a key.
     * 
     * @param string|int $key the key looked for
     */
    public function get(string|int $key)
    {
        if (!\array_key_exists($key, $this->params)) {
            throw new UnknownKeyException("Key '{$key}' does not exist in the parameter bag");
        }

        return $this->params[$key];
    }

    /**
     * Sets a key value pair.
     *
     * @param string|int $key   the kay for this pair
     * @param mixed  $value the value to store
     */
    public function set(string|int $key, mixed $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Sets all variables of the bag.
     *
     * @param array $params the content of the bag
     */
    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Gets all variables of the bag.
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
