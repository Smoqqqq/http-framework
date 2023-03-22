<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Router;

class RouteCacher
{
    private const CACHE_DIR = 'var';
    private const FILE_NAME = 'controllers.ser';
    private const FILE_PATH = self::CACHE_DIR.\DIRECTORY_SEPARATOR.self::FILE_NAME;

    public function save(string $serialized): void
    {
        $cacheFilePath = getcwd().\DIRECTORY_SEPARATOR.self::FILE_PATH;

        if (!is_dir('var')) {
            mkdir('var');
        }

        if (!file_exists($cacheFilePath)) {
            fopen($cacheFilePath, 'w+');
        }

        file_put_contents($cacheFilePath, $serialized);
    }

    public function cache(array $routes): void
    {
        $serialized = serialize($routes);

        $this->save($serialized);
    }

    public static function getCachedRoutes()
    {
        $cacheFilePath = getcwd().\DIRECTORY_SEPARATOR.self::FILE_PATH;

        return file_get_contents($cacheFilePath);
    }
}
