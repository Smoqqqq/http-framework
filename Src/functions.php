<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

function dd($var, ...$vars): void
{
    var_dump($var, $vars);

    exit;
}
