<?php

class DatabaseConnection
{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = 'database';
    protected $connect;

    public function getConnection()
    {
        $this->connect = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if ($this->connect->connect_error) {
            die('Connection failed: ' . $this->connect->connect_error);
        }

        return $this->connect;
    }
}
