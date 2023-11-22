<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getModel(): Model;

    public function getQuery(): Builder;

    public function getAll(?array $select = ['*'], ?array $with = []): Collection;

    public function create(array $data): Model;

    public function getById(int $id, ?array $with = [], ?array $select = []): ?Model;

    public function updateById(int $id, array $data): ?Model;

    public function delete(int $id): ?bool;
}
