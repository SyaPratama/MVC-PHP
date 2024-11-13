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
    var_dump(self::$routes);
  }
}