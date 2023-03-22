<?php

namespace App\Service;

class BarService {
    public function __construct(FooService $fooService)
    {
        echo "TEST";
    }
}