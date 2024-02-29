<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class AuthLoginRequest extends Request
{   
    public function validate()
    {
        if (!(isset($this->request['email']) && isset($this->request['password']))) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }
        
        return $this->request;
    }
}