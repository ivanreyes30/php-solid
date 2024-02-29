<?php

abstract class Repository
{
    protected $model;

    public function table()
    {
        return $this->model->getTable();
    }

    public function transactionCreate(array $request)
    {
        return $this->model->transactionCreate($request);
    }

    public function transactionUpdate(array $request, int $id)
    {
        return $this->model->transactionUpdate($request, $id);
    }

    public function transactionDelete(int $id)
    {
        return $this->model->transactionDelete($id);
    }

    public function getById(int $id)
    {
        return $this->model->getById($id);
    }
}
