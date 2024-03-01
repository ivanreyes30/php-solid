<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class StudentReadRequest extends Request
{
    public function validate()
    {
        $user = $this->authRepository->getById($this->request['account']['id']);

        if (!$user) return HttpResponse::failedValidation('User not exists.');

        return $this->request;
    }
}
