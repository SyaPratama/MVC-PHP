<?php

namespace MVC\App\Model;

class Model
{
    function __construct(protected $model = new \MVC\App\Core\Database()){}

    public function get(string $key,)
    {
        // $this->model->prepare();
    }
}