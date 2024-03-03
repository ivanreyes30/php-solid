<?php

include_once "$filepath/api/validations/Request.php";
include_once "$filepath/api/helpers/HttpResponse.php";

class AuthLogoutRequest extends Request
{
    public function validate()
    {
        if (!isset($_SESSION['account'])) {
            return HttpResponse::forbidden('Session not found.');
        }

        return $this->request;
    }
}
