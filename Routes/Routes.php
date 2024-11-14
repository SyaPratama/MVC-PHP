<?php

use App\Controller\Controller;
use App\Core\Route;

Route::Add("GET","/",Controller::class,"index");
Route::run();