<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;

class BaseService implements BaseServiceInterface
{
    protected $repository;
    protected $defaultRelations = [];

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return fn () => $this->repository->with($this->defaultRelations)->all();
    }

    public function delete(Model $model): void
    {
        $this->repository->delete($model->id);
    }

    public function forceDelete(Model $model): void
    {
        $this->repository->forceDelete($model->id);
    }

    public function store(array $data): Model
    {
        $model = $this->repository->create($data);
        return $this->find($model);
    }

    public function find(Model $model): Model
    {
        return fn () => $this->repository->with($this->defaultRelations)->find($model->id);
    }

    public function update(array $data, Model $model): Model
    {
        $model = $this->repository->update($data, $model->id);
        return $this->find($model);
    }
}
