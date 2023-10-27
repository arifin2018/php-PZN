<?php

namespace Arifin\PHP\MVC\Middlewares\interfaces;

interface Middleware{
    public function before(): void;
}