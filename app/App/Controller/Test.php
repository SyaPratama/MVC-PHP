<?php 

namespace MVC\App\Controller;

class Test 
{
  function index(Int $id,String $idTest)
  {
    var_dump([
      "id" => $id,
      "testId" => $idTest]);
  }
  function hello()
  {
    echo "Hello Konyol";
  }
}