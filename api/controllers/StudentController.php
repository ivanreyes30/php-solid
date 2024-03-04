<?php

include_once "$filepath/api/validations/contracts/ValidateInterface.php";
include_once "$filepath/api/services/StudentService.php";
include_once "$filepath/api/controllers/Controller.php";
include_once "$filepath/api/helpers/Auth.php";

class StudentController extends Controller
{
    public function __construct()
    {
        $this->service = new StudentService();
    }

    public function create(ValidateInterface $request)
    {
        $request = $request->validate();
        return $this->service->create($request);
    }

    public function update(ValidateInterface $request)
    {
        $request = $request->validate();
        // Auth::adminStudent($request['id']);
        Auth::admin();
        return $this->service->update($request);
    }

    public function delete(ValidateInterface $request)
    {
        Auth::admin();
        $request = $request->validate();
        return $this->service->delete($request);
    }

    public function read(ValidateInterface $request)
    {
        $request = $request->validate();
        Auth::student($request['account']['id']);
        return $this->service->read($request);
    }

    public function all(ValidateInterface $request)
    {
        Auth::admin();
        $request = $request->validate();
        return $this->service->all($request);
    }
}
