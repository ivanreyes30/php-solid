<?php

include_once "$filepath/api/routes/contracts/RouteInterface.php";

class RouteHandler
{
    public function handle(RouteInterface $route)
    {
        $baseEndPoint = '/php-solid';
        $request = $_SERVER['REQUEST_URI'];
        $url = str_replace($baseEndPoint, '', $request);
        return $route->redirect($url);
    }
}
