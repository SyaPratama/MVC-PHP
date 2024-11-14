<?php

namespace App\Middleware;

interface Middleware
{
    public function before(): void;
}