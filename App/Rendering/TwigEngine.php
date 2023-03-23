<?php

namespace App\Rendering;

use Smoq\Env\Env;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Smoq\Rendering\Contracts\RenderingEngineInterface;

class TwigEngine implements RenderingEngineInterface
{
    private const CACHE_DIR = 'var';
    private const FOLDER_NAME = 'twig';

    private FilesystemLoader $loader;
    private Environment $environment;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(getcwd() . DIRECTORY_SEPARATOR . "templates");

        $this->environment = new Environment($this->loader, [
            'cache' => self::CACHE_DIR . DIRECTORY_SEPARATOR . self::FOLDER_NAME,
            'debug' => Env::get("APP_ENV") === "prod" ? false : true,
            'strict_variables' => Env::get("APP_ENV") === "prod" ? false : true,
        ]);
    }

    public function render(string $templatePath, array $variables): string
    {
        $template = $this->environment->load($templatePath);

        return $template->render($variables);
    }
}
