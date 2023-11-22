<?php

namespace App\Interfaces\Repositories;

use App\Dto\TaskIndexDto;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface extends RepositoryInterface
{
    public function getAllByUserId(TaskIndexDto $dto);
}
