<?php

require_once("vendor/autoload.php");

use Smoq\Http\Request;
use Smoq\ParameterBag\ParameterBag;

$request = new Request();

$bag = new ParameterBag();

$bag->set("param1", "Parameter 1")
    ->set("param2", [1, 2, 3]);

var_dump($bag->get("param1") === "Parameter 1");