<?php

include_once "$filepath/api/helpers/HttpResponse.php";

class Auth
{
    protected static $adminRole = 1;
    protected static $studentRole = 2;

    public static function authenticated()
    {
        if (isset($_SESSION['account'])) return;

        return HttpResponse::unauthorized('Unauthorized');
    }

    public static function admin()
    {
        self::authenticated();

        if ($_SESSION['account']['role'] == self::$adminRole) return;

        return HttpResponse::unauthorized('Unauthorized');
    }

    public static function student(int $userId)
    {
        self::authenticated();

        if ($_SESSION['account']['role'] == self::$studentRole && $_SESSION['account']['id'] == $userId) return;

        return HttpResponse::forbidden('Forbidden.');
    }

    public static function adminStudent(int $userId)
    {
        self::authenticated();

        if ($_SESSION['account']['role'] == self::$adminRole) return;

        if ($_SESSION['account']['role'] == self::$studentRole && $_SESSION['account']['id'] == $userId) return;

        return HttpResponse::forbidden('Forbidden.');
    }
}
