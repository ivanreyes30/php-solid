<?php
include_once "$filepath/api/services/AuthService.php";
include_once "$filepath/api/controllers/Controller.php";
include_once "$filepath/api/validations/contracts/ValidateInterface.php";

class AuthController extends Controller
{
    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function login(ValidateInterface $request)
    {
        $request = $request->validate();
        return $this->service->login($request);
    }
}
