<?php

namespace App\Repositories;

use App\Dto\TaskIndexDto;
use App\Helpers\QueryFilter\QueryFilter;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use App\QueryFilters\TaskPriorityFilter;
use App\QueryFilters\TaskStatusFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;

class TaskRepository extends AbstractRepository implements TaskRepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new Task();
    }

    /**
     * @return array
     */
    public function getAllowedFilters(): array
    {
        return [
            AllowedFilter::custom('status', new TaskStatusFilter()),
            AllowedFilter::custom('priority', new TaskPriorityFilter())
        ];
    }

    /**
     * @return string[]
     */
    public function getAllowedSorts(): array
    {
        return [
            'created_at',
            'completed_at',
            'priority'
        ];
    }

    /**
     * @param TaskIndexDto $dto
     * @return Collection
     */
    public function getAllByUserId(TaskIndexDto $dto): Collection
    {
        $query = $this->getQuery()
            ->where('user_id', '=', $dto->getUserId())
            ->with('descendants')
            ->search($dto->getSearch());

        new QueryFilter($query, $this->getAllowedFilters(), $this->getAllowedSorts());

        if(! empty($dto->getFilter())) {
            return $query->get();
        }

        return $query->tree()->get();
    }
}
