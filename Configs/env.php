<?php

$env_path = realpath(__DIR__ . "/../.env");

if(!is_file($env_path))
{
    throw new ErrorException("Environment File Is Missing!");
}

if(!is_readable($env_path))
{
    throw new ErrorException("Permission Denied To Read The: $env_path");
}

if(!is_writable($env_path))
{
    throw new ErrorException("Permission Denied To Write This File: $env_path");
}

$env = [];

$fopen = fopen($env_path,"r");
if($fopen)
{
    while(($lines = fgets($fopen)) !== false)
    {
        $line_comment = (substr(trim($lines),0,1) == "#") ? true : false;

        if($line_comment || empty(trim($lines)))
        {
            continue;
        }

        $line_no_comment = explode("#",$lines,2)[0];
        $env_split = preg_split('/(\s?)\=(\s?)/',$line_no_comment);
        $env_name = trim($env_split[0]);
        $env_value = isset($env_split[1]) ? trim($env_split[1]) : "";
        $new_value = is_numeric($env_value) ? intval($env_value) : strval($env_value);
        $env[$env_name] = $new_value; 
    }
    fclose($fopen);
}

foreach($env as $name => $value)
{
    define($name,$value);
}
