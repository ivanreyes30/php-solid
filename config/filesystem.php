<?php

/*
|--------------------------------------------------------------------------
| Global Variables
|--------------------------------------------------------------------------
|
| These variables can access in all php files.
|
*/

$filepath = getcwd();
$baseEndPoint = '/php-solid';
$appUrl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$baseEndPoint";
