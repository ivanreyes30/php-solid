<?php

include_once "$filepath/api/repositories/Repository.php";
include_once "$filepath/api/models/User.php";

class AuthRepository extends Repository
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function getByEmail(string $email)
    {
        $query = sprintf(
            "SELECT
                users.id,
                first_name,
                middle_name,
                last_name,
                students.id AS student_id,
                email,
                password,
                role
            FROM 
                {$this->table()}
            LEFT JOIN
                students ON {$this->table()}.id = students.user_id
            WHERE
                email = '%s'",
            $email
        );
        $result = $this->model->getDataFromConnection($query);
        if (empty($result)) return null;
        return $result[0];
    }

    public function validate(string $email, string $password)
    {
        $result = $this->getByEmail($email);
        if (empty($result)) return false;

        $account = $result;
        $passwordHashed = $account['password'];
        $isPasswordCorrect = password_verify($password, $passwordHashed);

        if (!$isPasswordCorrect) return null;
        unset($account['password']);
        return $account;
    }

    public function setSession(array $account)
    {
        $_SESSION['account'] = $account;
    }
}
