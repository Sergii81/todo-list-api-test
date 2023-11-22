<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TaskPriorityFilter implements Filter
{

    /**
     * @inheritDoc
     */
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where('priority', $value);
    }
}
