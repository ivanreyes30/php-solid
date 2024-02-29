<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class StudentUpdateRequest extends Request
{   
    public function validate()
    {
        if (!(
            isset($this->request['email']) &&
            isset($this->request['password']) &&
            isset($this->request['first_name']) &&
            isset($this->request['middle_name']) &&
            isset($this->request['last_name']) &&
            isset($this->request['id'])
        )) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }
        
        return $this->request;
    }
}