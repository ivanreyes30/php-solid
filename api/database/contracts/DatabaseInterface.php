<?php

interface DatabaseInterface
{
    /**
     * For Singleton.
     */
    public static function setDbInstance();
    public static function getDbInstance();
    public static function beginTransaction();
    public static function rollback();


    /**
     * For Non-Singleton.
     */
    public function setConnectionInstance();
    public function getConnection();
}
