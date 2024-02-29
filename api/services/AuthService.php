<?php

include_once "$filepath/api/services/Service.php";
include_once "$filepath/api/repositories/AuthRepository.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class AuthService extends Service
{
    public function __construct()
    {
        $this->repository = new AuthRepository();
    }

    public function login(array $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $account = $this->repository->validate($email, $password);
        $this->repository->setSession($account);
        return HttpResponse::success($account);
    }
}
