<?php

namespace App\Dto;

use App\Enum\TaskStatusEnum;
use Illuminate\Http\Request;

class TaskCreateDto
{
    /**
     * @param int $user_id
     * @param TaskStatusEnum $status
     * @param int $priority
     * @param string $title
     * @param string|null $description
     * @param int|null $parent_id
     */
    public function __construct(
        private readonly int $user_id,
        private readonly TaskStatusEnum $status,
        private readonly int $priority,
        private readonly string $title,
        private readonly ?string $description,
        private readonly ?int $parent_id
    ) {
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            user_id: auth('sanctum')->user()->getAuthIdentifier(),
            status: TaskStatusEnum::TODO,
            priority: ! empty($request->priority) ? $request->priority : null,
            title: $request->title,
            description: ! empty($request->description) ? $request->description : null,
            parent_id: ! empty($request->parent_id) ? $request->parent_id : null
        );
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return TaskStatusEnum
     */
    public function getStatus(): TaskStatusEnum
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
