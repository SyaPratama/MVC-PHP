<?php

use MVC\App\Controller\Controller;
use MVC\App\Core\Route;

Route::Add("GET","/",Controller::class,"index");
Route::run();