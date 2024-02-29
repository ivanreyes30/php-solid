<?php

include_once "$filepath/api/validations/contracts/ValidateInterface.php";

abstract class Request implements ValidateInterface
{
    protected $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }
}