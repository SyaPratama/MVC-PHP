<?php 

namespace MVC\App\Controller;

use MVC\App\Core\View;

class Controller
{
  public function index()
  {
    View::render("welcome",[]);
  }
}