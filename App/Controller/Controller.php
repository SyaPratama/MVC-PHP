<?php 

namespace App\Controller;

use App\Core\View;

class Controller
{
  public function index()
  {
    View::render("welcome",[
      "title" => "Welcome Page"
    ]);
  }
}