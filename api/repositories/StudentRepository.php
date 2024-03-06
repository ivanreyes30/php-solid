<?php

include_once "$filepath/api/repositories/Repository.php";
include_once "$filepath/api/models/Student.php";

class StudentRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Student();
    }

    public function getStudentAccountById(int $studentId)
    {
        $query = "
            SELECT
                students.id,
                name,
                age,
                gpa,
                users.id AS user_id,
                email,
                role 
            FROM
                {$this->table()}
            LEFT JOIN
                users ON {$this->table()}.user_id = users.id
            WHERE
                students.id = '$studentId'
        ";

        $result = $this->model->getDataFromTransaction($query);

        if (empty($result)) return null;

        return $result[0];
    }

    public function getAllStudents(array $request)
    {
        $page = $request['page'] > 1 ? (($request['page'] - 1) * $request['per_page']) : 0;
        $perPage = $request['per_page'];

        $query = "
            SELECT
                students.id,
                name,
                age,
                gpa,
                users.id AS user_id,
                email,
                role 
            FROM
                {$this->table()}
            LEFT JOIN
                users ON {$this->table()}.user_id = users.id
            ORDER BY id DESC
            LIMIT
                $perPage
            OFFSET
                $page
        ";

        return $this->model->paginate($query, $request, 'student/all');
    }
}
