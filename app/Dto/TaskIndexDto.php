<?php

namespace App\Dto;

use Illuminate\Http\Request;

class TaskIndexDto
{
    /**
     * @param int $userId
     * @param string|null $search
     */
    public function __construct(
        private int $userId,
        private ?string $search,
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
            search: ! empty($request->search) ? $request->search : null
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
}
