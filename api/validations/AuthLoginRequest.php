<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";
include_once "$filepath/api/repositories/AuthRepository.php";

class AuthLoginRequest extends Request
{
    public function validate()
    {
        if (!(isset($this->request['email']) && isset($this->request['password']))) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }

        $account = $this->authRepository->validate($this->request['email'], $this->request['password']);

        if (!$account) {
            return HttpResponse::unauthorized('Invalid Email Address or Password.');
        }

        return $this->request;
    }
}