<?php

class Session
{
    protected static $appUrl;

    public static function hasSession()
    {
        if (!isset($_SESSION['account'])) return;

        $role = $_SESSION['account']['role'];
        global $appUrl;

        if ($role == 1) header("Location: $appUrl/web/admin/home");
        else header("Location: $appUrl/web/student/home");
        exit();
    }

    public static function unauthorized()
    {
        if (isset($_SESSION['account'])) return;

        global $appUrl;
        header("Location: $appUrl/web/unauthorized");
        exit();
    }

    public static function adminPage()
    {
        self::unauthorized();
        if ($_SESSION['account']['role'] == 1) return;

        global $appUrl;
        header("Location: $appUrl/web/forbidden");
        exit();
    }

    public static function studentPage()
    {
        self::unauthorized();
        if ($_SESSION['account']['role'] == 2) return;

        global $appUrl;
        header("Location: $appUrl/web/forbidden");
        exit();
    }

    public static function notFound()
    {
        global $appUrl;
        header("Location: $appUrl/web/not-found");
        exit();
    }
}
