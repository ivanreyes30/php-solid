<?php

include_once "$filepath/api/validations/contracts/ValidateInterface.php";
include_once "$filepath/api/repositories/AuthRepository.php";
include_once "$filepath/api/repositories/StudentRepository.php";

abstract class Request implements ValidateInterface
{
    protected $request;
    protected $authRepository;
    protected $studentRepository;

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->authRepository = new AuthRepository();
        $this->studentRepository = new StudentRepository();
    }
}
