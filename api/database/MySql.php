<?php

include_once "$filepath/api/database/contracts/DatabaseInterface.php";

class MySql implements DatabaseInterface
{
    protected static $host = 'localhost';
    protected static $user = 'root';
    protected static $password = '';
    protected static $database = 'database';
    protected static $dbInstance;

    protected $connection;

    public function __construct()
    {
        $this->setConnectionInstance();
        self::setDbInstance();
    }

    public function setConnectionInstance()
    {
        $this->connection = new mysqli(self::$host, self::$user, self::$password, self::$database);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public static function setDbInstance()
    {
        if (!isset(self::$dbInstance)) {
            self::$dbInstance = new mysqli(self::$host, self::$user, self::$password, self::$database);
        }
    }

    public static function getDbInstance()
    {
        return self::$dbInstance;
    }

    public static function beginTransaction()
    {
        return self::$dbInstance->begin_transaction();
    }

    public static function rollback()
    {
        return self::$dbInstance->rollback();
    }

    public static function commit()
    {
        return self::$dbInstance->commit();
    }
}
