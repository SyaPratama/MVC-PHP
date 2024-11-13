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
    $params = [];
    if(isset($url[0]))
    {
      $path .= join("/",$url);
    }
    $method = $_SERVER["REQUEST_METHOD"];
    foreach (self::$routes as $routing)
    {
      $reqUri = explode("/",$path);
      $uri = explode("/",$routing["path"]);
      
      preg_match_all("/(?<={).+?(?=})/",$routing["path"],$result);
      if(empty($result[0]))
      {
        if($method != $routing["method"] && $path != $routing["path"]) return;
      call_user_func_array([$controller,$function],$params);
       return;
      }
      
      $paramKey = [];
      foreach ($result[0] as $key)
      {
        array_push($paramKey,$key);
      }
      
      $indexUri = [];
      foreach ($uri as $index => $param)
      {
        if(preg_match("/{.*}/",$param))
        {
          array_push($indexUri,$index);
        }
      }
      
      foreach ($indexUri as $key => $index)
      {
        if(empty($reqUri[$index]))
        {
          return;
        }
       $params[$paramKey[$key]] = $reqUri[$index];
      }
      call_user_func_array([$controller,$function],$params);
      exit(200);
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