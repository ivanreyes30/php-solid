<?php

include_once "$filepath/api/database/contracts/DatabaseInterface.php";

abstract class Database implements DatabaseInterface
{
    protected static $host;
    protected static $user;
    protected static $password;
    protected static $database;
    protected static $instance;

    // public static function getInstance()
    // {
    //     if (!isset(self::$instance)) {
    //         self::$instance = mysqli_connect(self::$host, self::$user, self::$password, self::$database);
    //     }

    //     return self::$instance;
    // }

    // public static function beginTransaction()
    // {
    //     return self::$instance->begin_transaction();
    // }

    // public static function rollback()
    // {
    //     return self::$instance->rollback();
    // }
}
