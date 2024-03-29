<?php

namespace App\Dto;

use Illuminate\Http\Request;

class TaskIndexDto
{
    /**
     * @param int $userId
     * @param string|null $search
     * @param array|null $filter
     */
    public function __construct(
        private readonly int $userId,
        private readonly ?string $search,
        private readonly ?array $filter
    ) {
    }

    /**
     * @param Request $request
     * @return static
     */
    public static function fromRequest(Request $request): static
    {
        return new static(
            userId: auth('sanctum')->user()->getAuthIdentifier(),
            search: ! empty($request->search) ? $request->search : null,
            filter: ! empty($request->filter) ? $request->filter : null,
        );
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return array|null
     */
    public function getFilter(): ?array
    {
        return $this->filter;
    }
}
