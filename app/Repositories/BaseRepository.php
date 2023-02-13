<?php

namespace App\Repositories;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
use Illuminate\Database\Eloquent\Model as SqlModel;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{
    private SqlModel|MongoModel $model;

    protected function model(): string
    {
        $model = str_replace('Repository','',class_basename($this));
        $folder = config('database.default') == 'mongodb' ? "Mongo" : "Sql";

        return "App\Models\\$folder\\$model";
    }

    public function __construct(){$this->model = app($this->model());}

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function find(int|string $id): mixed
    {
        return $this->model->find($id);
    }

    public function update(array $data, int|string $id): bool
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int|string $id): bool
    {
        return $this->model->destroy($id);
    }
}

