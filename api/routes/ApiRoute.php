<?php

include_once "$filepath/routing/contracts/RouteInterface.php";
include_once "$filepath/api/controllers/AuthController.php";
include_once "$filepath/api/controllers/StudentController.php";
include_once "$filepath/api/validations/AuthLoginRequest.php";
include_once "$filepath/api/validations/AuthLogoutRequest.php";
include_once "$filepath/api/validations/StudentCreateRequest.php";
include_once "$filepath/api/validations/StudentUpdateRequest.php";
include_once "$filepath/api/validations/StudentDeleteRequest.php";
include_once "$filepath/api/validations/StudentReadRequest.php";
include_once "$filepath/api/validations/StudentAllRequest.php";

class ApiRoute implements RouteInterface
{
    protected $auth;
    protected $student;

    public function __construct()
    {
        $this->auth = new AuthController();
        $this->student = new StudentController();
        header('Content-Type: application/json; charset=utf-8');
    }

    public function redirect(string $url)
    {
        switch (true) {
            case str_contains($url, '/auth/login'):
                $request = new AuthLoginRequest($_POST);
                $this->auth->login($request);
                break;

            case str_contains($url, '/auth/logout'):
                $request = new AuthLogoutRequest([]);
                $this->auth->logout($request);
                break;

            case str_contains($url, '/student/create'):
                $request = new StudentCreateRequest($_POST);
                $this->student->create($request);
                break;

            case str_contains($url, '/student/update'):
                $request = new StudentUpdateRequest($_POST);
                $this->student->update($request);
                break;

            case str_contains($url, '/student/delete'):
                $request = new StudentDeleteRequest($_POST);
                $this->student->delete($request);
                break;

            case str_contains($url, '/student/read'):
                $request = new StudentReadRequest($_SESSION);
                $this->student->read($request);
                break;

            case str_contains($url, '/student/all'):
                $request = new StudentAllRequest($_GET);
                $this->student->all($request);
                break;
        }
    }
}
