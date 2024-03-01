<?php
session_start();
include_once './config/filesystem.php';
include_once "$filepath/routing/RouteHandler.php";
include_once "$filepath/api/routes/ApiRoute.php";
include_once "$filepath/web/routes/WebRoute.php";

$baseEndPoint = '/php-solid';
$request = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$url = str_replace($baseEndPoint, '', $request);
$handler = new RouteHandler();

switch (true) {
    case str_contains($url, 'api'):
        $route = new ApiRoute();
        $handler->handle($route);
        break;

    case str_contains($url, 'web'):
        $route = new WebRoute();
        $handler->handle($route);
        break;
}
