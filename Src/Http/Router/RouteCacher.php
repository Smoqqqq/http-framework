<?php

namespace Smoq\Http\Router;

class RouteCacher
{

    private const CACHE_DIR = "var";
    private const FILE_NAME = "controllers.ser";
    private const FILE_PATH = self::CACHE_DIR . DIRECTORY_SEPARATOR . self::FILE_NAME;

    public function save(string $serialized)
    {
        $cacheFilePath = getcwd() . DIRECTORY_SEPARATOR . self::FILE_PATH;

        if (!is_dir("var")) {
            mkdir("var");
        }

        if (!file_exists($cacheFilePath)) {
            fopen($cacheFilePath, "w+");
        }

        file_put_contents($cacheFilePath, $serialized);
    }

    public function cache(array $routes)
    {
        $serialized = serialize($routes);

        $this->save($serialized);
    }

    public static function getCachedRoutes() {
        $cacheFilePath = getcwd() . DIRECTORY_SEPARATOR . self::FILE_PATH;

        $routes = file_get_contents($cacheFilePath);

        return $routes;
    }
}
