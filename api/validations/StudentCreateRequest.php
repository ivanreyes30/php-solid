<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";
include_once "$filepath/api/repositories/AuthRepository.php";

class StudentCreateRequest extends Request
{
    public function validate()
    {
        if (!(
            isset($this->request['email']) &&
            isset($this->request['password']) &&
            isset($this->request['first_name']) &&
            isset($this->request['middle_name']) &&
            isset($this->request['last_name'])
        )) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }

        $emailIsExists = $this->authRepository->getByEmail($this->request['email']);

        if (!empty($emailIsExists)) {
            return HttpResponse::failedValidation('Email already exists.');
        }
        
        return $this->request;
    }
}