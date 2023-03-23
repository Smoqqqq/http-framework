# Using a rendering engine
The framework comes bare bones, no rendering engine installed.
BUT, it is ready to use one when you want it. 

You can implement any templating engine using this simple method :

## Creating the factory
first, create a file called `RenderingEngineFactory`, located in `App\Factory`.
this allows you to use multiple engines if you want.

This factory must implement `\Smoq\Rendering\Contracts\RenderingEngineFactoryInterface`.
this basically forces you to have a `create` method, that instanciates rendering engines.
here is a minimal example :

```php
<?php
// App/Factory/RenderingEngineFactory.php

namespace App\Factory;

use App\Rendering\TwigEngine;
use Smoq\Rendering\Contracts\RenderingEngineFactoryInterface;
use Smoq\Rendering\Contracts\RenderingEngineInterface;

class RenderingEngineFactory implements RenderingEngineFactoryInterface
{
    public function create(): RenderingEngineInterface
    {
        return new TwigEngine();
    }
}

```

## Creating an engine
Create the `App\Rendering` folder. Now create your engine class inside. 
it has to implement `\Smoq\Rendering\Contracts\RenderingEngineInterface`.
here is an basic example using twig :

```php
<?php
// App/Rendering/TwigEngine.php

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

```

## Rendering a template from a controller
To render a template, you can simply use the `AbstractController::render(string $template, array $variables = [], array $headers = [], int $statusCode = 200)` method. It will throw `\Smoq\Rendering\Exception\NoRenderingEngineSetException` if no factory is found.

## Rendering raw text
You have the possibility to render raw HTML, JSON or really anything you want, using the `AbtractController::renderRaw(string $content = "", array $headers = [], int $statusCode = 200)` method.