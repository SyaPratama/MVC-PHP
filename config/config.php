<?php

require_once __DIR__ . "/./env.php";

$BASEURL = "" ;

if ( APP_STATUS == "local" || APP_STATUS == "dev") {
    switch ($_SERVER["HTTP_HOST"]) {
        case "localhost":
            $url = $_SERVER["PHP_SELF"];
            $servername = $_SERVER["SERVER_NAME"];
            $url = rtrim($url, "public/index.php");
            $BASEURL = "http://$servername{$url}";
            break;
        default:
            $servername = $_SERVER["SERVER_NAME"];
            $BASEURL = "http://$servername";
            break;
    }
} else if ( APP_STATUS == "prod" || APP_STATUS == "production") {
    $servername = $_SERVER["SERVER_NAME"];
    $BASEURL = "https://$servername";
}