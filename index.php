<?php
session_start();
include_once './api/config/filesystem.php';

include_once "$filepath/api/controllers/AuthController.php";
include_once "$filepath/api/validations/AuthLoginRequest.php";


include_once "$filepath/api/controllers/StudentController.php";
include_once "$filepath/api/validations/StudentCreateRequest.php";
include_once "$filepath/api/validations/StudentUpdateRequest.php";
include_once "$filepath/api/validations/StudentDeleteRequest.php";
include_once "$filepath/api/validations/StudentReadRequest.php";
include_once "$filepath/api/validations/StudentAllRequest.php";

$baseEndPoint = '/php-solid';
$request = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$url = str_replace($baseEndPoint, '', $request);

$auth = new AuthController();
$student = new StudentController();

switch (true) {
    case str_contains($url, '/api/auth/login'):
        $request = new AuthLoginRequest($_POST);
        $auth->login($request);
        break;

    case str_contains($url, '/api/student/create'):
        $request = new StudentCreateRequest($_POST);
        $student->create($request);
        break;

    case str_contains($url, '/api/student/update'):
        $request = new StudentUpdateRequest($_POST);
        $student->update($request);
        break;

    case str_contains($url, '/api/student/delete'):
        $request = new StudentDeleteRequest($_POST);
        $student->delete($request);
        break;

    case str_contains($url, '/api/student/read'):
        $request = new StudentReadRequest($_SESSION);
        $student->read($request);
        break;

    case str_contains($url, '/api/student/all'):
        $request = new StudentAllRequest($_POST);
        $student->all($request);
        break;
}
