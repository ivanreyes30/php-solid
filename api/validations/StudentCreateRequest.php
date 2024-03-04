<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class StudentCreateRequest extends Request
{
    public function validate()
    {
        if (!(
            isset($this->request['email']) &&
            isset($this->request['password']) &&
            isset($this->request['name']) &&
            isset($this->request['age']) &&
            isset($this->request['gpa'])
        )) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }

        if (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
            return HttpResponse::failedValidation('Invalid Email Format.');
        }

        if ($this->request['gpa'] < 1.00 || $this->request['gpa'] > 5.00) {
            return HttpResponse::failedValidation('GPA must be between 1.00 and 5.00');
        }

        $emailIsExists = $this->authRepository->getByEmail($this->request['email']);

        if (!empty($emailIsExists)) {
            return HttpResponse::failedValidation('Email already exists.');
        }

        return $this->request;
    }
}
