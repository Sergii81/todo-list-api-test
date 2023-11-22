<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TaskStatusFilter implements Filter
{

    /**
     * @inheritDoc
     */
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where('status', $value);
    }
}
