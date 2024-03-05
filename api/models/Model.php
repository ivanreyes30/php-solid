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

    public function getCount()
    {
        $query = "SELECT count(*) FROM {$this->table}";
        $result = $this->database()->query($query)->fetch_row();

        return (int) $result[0];
    }

    public function paginate(string $query, array $request, string $endpoint)
    {
        global $apiUrl;
        $result = $this->getDataFromConnection($query);
        $totalCount = $this->getCount();
        $showPagination = 3;
        $totalPage = (int) ceil($totalCount / $request['per_page']);
        $pagination = [];
        $finalPagination = [];
        $startingIndex = 0;

        if ($request['page'] > $totalPage) {
            throw new Exception('Pagination failed.', 500);
        }

        for ($index = 0; $index < $totalPage; $index++) {
            $page = $index + 1;
            $pagination[] = [
                'label' => $page,
                'url' => "$apiUrl/$endpoint?page={$page}&per_page={$request['per_page']}",
            ];
        }

        if ($showPagination < count($pagination)) {
            foreach ($pagination as $key => $value) {
                if ($value['label'] == $request['page']) $startingIndex = $key;
            }

            switch (true) {
                case ($request['page'] == $totalPage):
                    $indexPagination = $startingIndex - ($showPagination - 1);
                    break;

                case ($request['page'] == 1):
                    $indexPagination = $startingIndex;
                    break;

                default:
                    $indexPagination = $startingIndex - 1;
                    break;
            }

            for ($index = $indexPagination; $index < count($pagination); $index++) {
                if (count($finalPagination) === $showPagination) break;
                $finalPagination[] = $pagination[$index];
            }
        }

        return [
            'data' => $result,
            'pagination' => empty($finalPagination) ? $pagination : $finalPagination,
            'current_page' => (int) $request['page'],
            'per_page' => (int) $request['per_page'],
            'total_page' => (int) $totalPage,
        ];
    }
}
