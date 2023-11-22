<?php

namespace App\Helpers\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\QueryBuilder;

class QueryFilter extends QueryBuilder
{
    /**
     * @param Builder|Relation $query
     * @param array|null $filters
     * @param array|null $sorts
     * @param string|null $defaultSort
     */
    public function __construct(Builder|Relation $query, ?array $filters = null, ?array $sorts = null, ?string $defaultSort = null)
    {
        parent::__construct($query);

        if ($sorts) {
            $this->allowedSorts($sorts);
        }

        if ($filters) {
            $this->allowedFilters($filters);
        }

        if ($defaultSort) {
            $this->defaultSorts($defaultSort);
        }
    }
}
