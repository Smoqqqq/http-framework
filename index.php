<?php

require_once("vendor/autoload.php");

use App\Service\FooService;
use Smoq\DependencyInjection\Container;
use Smoq\Http\Kernel;

new Kernel();

$container = new Container();

$container->set(FooService::class, function() {
    return new FooService();
});