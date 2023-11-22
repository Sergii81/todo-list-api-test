<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new User();
    }

    /**
     * @return array
     */
    public function getAllowedFilters(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAllowedSorts(): array
    {
        return [];
    }
}
