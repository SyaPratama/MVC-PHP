<?php

namespace App\Model;

class Model
{
    function __construct(protected $model = new \App\Core\Database()){}

    public function get(string $key)
    {
        $this->model->prepare("SELECT * FROM $key");
        return $this->model->fetch();
    }
}