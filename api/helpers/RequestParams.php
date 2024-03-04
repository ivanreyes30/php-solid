<?php

class RequestParams
{
    public static function student(array $request, int $userId = null)
    {
        $params = [
            'name' => $request['name'],
            'age' => $request['age'],
            'gpa' => $request['gpa'],
        ];

        if ($userId) $params['user_id'] = $userId;

        return $params;
    }

    public static function user(array $request, int $role = null)
    {
        $params = [
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT)
        ];

        if ($role) $params['role'] = $role;

        return $params;
    }
}
