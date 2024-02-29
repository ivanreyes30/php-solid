<?php

class HttpResponse
{
    public static function unauthorized(string $message)
    {
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(['status' => false, 'message' => $message]);
        exit;
    }

    public static function forbidden(string $message)
    {
        header('HTTP/1.0 403 Forbidden');
        echo json_encode(['status' => false, 'message' => $message]);
        exit;
    }

    public static function failedValidation(string $message)
    {
        header('HTTP/1.0 422 Unprocessable Entity');
        echo json_encode(['status' => false, 'message' => $message]);
        exit;
    }

    public static function internalServerError(string $message)
    {
        header('HTTP/1.0 500 Internal server error');
        echo json_encode(['status' => false, 'message' => $message]);
        exit;
    }

    public static function success(array $data)
    {
        header('HTTP/1.0 200 OK Success');
        echo json_encode($data);
    }

    public static function created(array $data)
    {
        header('HTTP/1.0 201 Created');
        echo json_encode($data);
    }

    public static function badRequest(string $message)
    {
        header('HTTP/1.0 500 Internal server error');
        echo json_encode(['status' => false, 'message' => $message]);
        exit;
    }
}
