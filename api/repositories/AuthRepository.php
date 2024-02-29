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
        $query = sprintf("SELECT * FROM {$this->table()} WHERE email = '%s'", $email);
        $result = $this->model->getDataFromConnection($query);
        if (empty($result)) return [];
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

    public function createUser($request)
    {
        $query = sprintf(
            "INSERT INTO {$this->table()} (email, password, role, created_at, updated_at) VALUES ('%s', '%s', '%s', '%s', '%s')",
            $request['email'],
            password_hash($request['password'], PASSWORD_BCRYPT),
            2, // role type
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s')
        );

        return $this->model->transactionCreate($query);
    }

    public function setSession(array $account)
    {
        $_SESSION['account'] = $account;
    }
}
