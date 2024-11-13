<?php

namespace MVC\App\Core;

class Route
{
  static private Array $routes = [];
  
  static function Add(String $method,String $path,String $controller,String $function, Array $middlewares= []): void
  {
    array_push(self::$routes,[
      "method" => $method,
      "path" => $path,
      "controller" => $controller,
      "function" => $function,
      "middlewares" => $middlewares
      ]);
  }
  
  static function run(): void
  {
    $path = "/";
    $url = self::parseURL();
    if(isset($url[0]))
    {
      $path .= join("/",$url);
    }
    
    $method = $_SERVER["REQUEST_METHOD"];
    foreach (self::$routes as $routing)
    {
      var_dump($method);
    }
  }
  
  static function parseURL()
  {
    if(isset($_GET["url"]))
    {
      $url = rtrim($_GET["url"],"/");
      $url = filter_var($url,FILTER_SANITIZE_URL);
      $url = explode("/",$url);
      return $url;
    }
  }
}