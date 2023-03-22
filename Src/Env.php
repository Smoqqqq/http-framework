<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq;

class Env
{

    private static array $variables;

    public static function setVariables(array $variables = []): static
    {
        static::$variables = $variables;

        return new static();
    }

    /**
     * Gets the value associated with a key.
     *
     * @param int|string $key the key looked for
     */
    public static function get(string|int $key): mixed
    {
        if (!\array_key_exists($key, static::$variables)) {
            throw new \Exception("Key '{$key}' does not exist in the parameter bag");
        }

        return static::$variables[$key];
    }

    /**
     * Gets full env
     */
    public static function getEnv(): array
    {
        return static::$variables;
    }
}
