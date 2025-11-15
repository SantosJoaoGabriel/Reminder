<?php

namespace App\Http\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find(string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $data, string $id)
    {
        $instance = $this->find($id);
        $instance->update($data);
        return $instance;
    }

    public function delete(string $id)
    {
        $instance = $this->find($id);
        return $instance->delete();
    }
}