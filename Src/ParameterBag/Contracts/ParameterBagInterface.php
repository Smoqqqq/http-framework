<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\ParameterBag\Contracts;

interface ParameterBagInterface
{
    public function __construct(array $params = []);

    /**
     * Gets the value associated with a key.
     *
     * @param int|string $key the key looked for
     */
    public function get(string|int $key): mixed;

    /**
     * Sets a key value pair.
     *
     * @param int|string $key   the kay for this pair
     * @param mixed      $value the value to store
     */
    public function set(string|int $key, mixed $value): self;

    /**
     * Sets all variables of the bag.
     *
     * @param array $params the content of the bag
     */
    public function setParams(array $params): self;

    /**
     * Gets all variables of the bag.
     */
    public function getParams(): array;
}
