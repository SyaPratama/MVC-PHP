<?php 

namespace MVC\App\Controller;

class Test 
{
  function index(String $id,String $idTest)
  {
    var_dump([
      "id" => $id,
      "testId" => $idTest]);
  }
  function hello()
  {
    echo "Hello";
  }
}