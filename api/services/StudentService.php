<?php

include_once "$filepath/api/services/Service.php";
include_once "$filepath/api/repositories/StudentRepository.php";
include_once "$filepath/api/repositories/AuthRepository.php";
include_once "$filepath/api/helpers/HttpResponse.php";
include_once "$filepath/api/helpers/RequestParams.php";
include_once "$filepath/api/database/MySql.php";

class StudentService extends Service
{
    protected $authRepository;

    public function __construct()
    {
        $this->repository = new StudentRepository();
        $this->authRepository = new AuthRepository();
    }

    public function create(array $request)
    {
        $emailIsExists = $this->authRepository->getByEmail($request['email']);

        if (!empty($emailIsExists)) {
            HttpResponse::failedValidation('Email already exists.');
        }

        $userParams = RequestParams::user($request, 2);
        MySql::beginTransaction();

        try {
            $userId = $this->authRepository->transactionCreate($userParams);

            $studentParams = RequestParams::student($request, $userId);
            $studentId = $this->repository->transactionCreate($studentParams);

            Mysql::commit();

            $student = $this->repository->getStudentAccountById($studentId);
            return HttpResponse::created($student);
        } catch (\Exception $exception) {
            MySql::rollback();
            return HttpResponse::internalServerError($exception->getMessage());
        }
    }

    public function update(array $request)
    {
        $student = $this->repository->getStudentAccountById($request['id']);

        if (!$student) return HttpResponse::badRequest('Student is not exists.');

        $emailIsExists = $this->authRepository->getByEmail($request['email']);

        if (!empty($emailIsExists) && $student['email'] !== $request['email']) {
            return HttpResponse::failedValidation('Email already exists.');
        }

        $userParams = RequestParams::user($request);
        MySql::beginTransaction();

        try {
            $this->authRepository->transactionUpdate($userParams, $student['user_id']);

            $studentParams = RequestParams::student($request);
            $this->repository->transactionUpdate($studentParams, $request['id']);

            Mysql::commit();

            $student = $this->repository->getStudentAccountById($request['id']);
            return HttpResponse::success($student);
        } catch (\Exception $exception) {
            MySql::rollback();
            return HttpResponse::internalServerError($exception->getMessage());
        }
    }
}
