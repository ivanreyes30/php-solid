<?php

include_once "$filepath/api/database/MySql.php";
include_once "$filepath/api/helpers/HttpResponse.php";

abstract class Model
{
    protected $database;
    protected $table;

    public function __construct()
    {
        $this->database = new MySql();
    }

    public function getTable()
    {
        return $this->table;
    }

    public function database()
    {
        return $this->database->getConnection();
    }

    public function transaction()
    {
        return $this->database->getDbInstance();
    }

    public function transactionCreate(array $request)
    {
        $request['created_at'] = date('Y-m-d H:i:s');
        $request['updated_at'] = date('Y-m-d H:i:s');
        $columns = implode(', ', array_keys($request));
        $values = '"' . implode('", "', $request) . '"';

        $query = "INSERT INTO {$this->table} ($columns) VALUES (" . $values . ")";
        $created = $this->transaction()->query($query);

        if (!$created) throw new Exception('Failed to Insert Data.', 500);

        return $this->transaction()->insert_id;
    }

    public function transactionUpdate(array $request, int $id)
    {
        $request['updated_at'] = date('Y-m-d H:i:s');
        $set = [];
        foreach ($request as $key => $value) {
            $set[] = "$key = '{$value}'";
        }

        $set = implode(', ', $set);
        $query = "UPDATE {$this->table} SET $set WHERE id = '$id'";
        $updated = $this->transaction()->query($query);

        if (!$updated) throw new Exception('Failed to Update Data.', 500);

        return $updated;
    }

    public function transactionDelete(int $id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = '$id'";
        $deleted = $this->transaction()->query($query);
        
        if (!$deleted) throw new Exception('Failed to Update Data.', 500);

        return $deleted;
    }

    public function getDataFromConnection($query)
    {
        $result = [];
        $sql = $this->database()->query($query);
        while ($row = mysqli_fetch_assoc($sql)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getDataFromTransaction($query)
    {
        $result = [];
        $sql = $this->transaction()->query($query);
        while ($row = mysqli_fetch_assoc($sql)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = '$id'";
        $result = $this->getDataFromConnection($query);
        
        if (empty($result)) return null;
        return $result[0];
    }
}
