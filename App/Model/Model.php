<?php

namespace App\Model;

class Model
{
    function __construct(protected $model = new \App\Core\Database()){}
}