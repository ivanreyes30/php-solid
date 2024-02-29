<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class StudentDeleteRequest extends Request
{   
    public function validate()
    {
        if (!isset($this->request['id'])) {
            return HttpResponse::failedValidation('Invalid Parameter Requests.');
        }

        $student = $this->studentRepository->getStudentAccountById($this->request['id']);

        if (!$student) return HttpResponse::failedValidation('Student is not exists.');
        
        return $this->request;
    }
}