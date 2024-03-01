<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class StudentAllRequest extends Request
{
    public function validate()
    {
        if (!(
            isset($this->request['page']) &&
            isset($this->request['per_page'])
        )) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }

        return $this->request;
    }
}
