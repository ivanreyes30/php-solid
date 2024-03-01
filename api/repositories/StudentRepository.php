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
                first_name,
                middle_name,
                last_name,
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

    public function getAllStudents(int $page, int $perPage)
    {
        $query = "
            SELECT
                students.id,
                first_name,
                middle_name,
                last_name,
                users.id AS user_id,
                email,
                role 
            FROM
                {$this->table()}
            LEFT JOIN
                users ON {$this->table()}.user_id = users.id
            LIMIT
                $perPage
            OFFSET
                $page
        ";

        return $this->model->getDataFromConnection($query);
    }
}
