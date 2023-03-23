<?php

namespace Smoq\Env;

class DefaultEnvironment {

    private const DEFAULT_ENV = [
        "TEMPLATING_ENGINE" => false,
        "APP_ENV" => "prod"
    ];

    /**
     * Sets the env variables at their default values
     */
    public static function setDefaults() {
        Env::setVariables(self::DEFAULT_ENV);
    }

    /**
     * Gets default env variables without actually saving them to `Env`
     */
    public static function getDefaults(): array
    {
        return self::DEFAULT_ENV;
    }
}