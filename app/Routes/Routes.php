<?php

use MVC\App\Core\Route;
use MVC\App\Controller\Test;


Route::add("GET","/hello/{id}/test/{idTest}",Test::class,"index");
Route::add("GET","/hello",Test::class,"hello");
Route::run();