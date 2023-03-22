<?php

namespace Smoq\Rendering;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Smoq\Rendering\Contracts\RendererInterface;

class TwigRenderer implements RendererInterface
{

    private const CACHE_DIR = 'var';
    private const FOLDER_NAME = 'twig';

    private static FilesystemLoader $loader;
    private static Environment $environment;

    public static function init()
    {
        static::$loader = new FilesystemLoader(getcwd() . DIRECTORY_SEPARATOR . "templates");
        static::$environment = new Environment(static::$loader, [
            'cache' => self::CACHE_DIR . DIRECTORY_SEPARATOR . self::FOLDER_NAME
        ]);
    }

    public static function render(string $templatePath, array $variables)
    {
        $template = static::$environment->load($templatePath);

        return $template->render($variables);
    }
}
