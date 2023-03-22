<?php

namespace App\Service;

class FooService {
    public function __construct()
    {
        echo "HELLO FooService<br>";
    }

    public function sayHi() {
        echo "HI";
    }
}