<?php

namespace App\Dto;

use App\Enum\TaskStatusEnum;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskUpdateDto
{
    /**
     * @param int $user_id
     * @param string|null $status
     * @param int|null $priority
     * @param string|null $title
     * @param string|null $description
     * @param int|null $parent_id
     * @param string|null $completed_at
     */
    public function __construct(
        private readonly int $user_id,
        private readonly ?string $status,
        private readonly ?int $priority,
        private readonly ?string $title,
        private readonly ?string $description,
        private readonly ?int $parent_id,
        private readonly ?string $completed_at
    ) {
    }

    /**
     * @param Request $request
     * @return static
     */
    public static function fromRequest(Request $request): static
    {
        $task = Task::query()->where('id', '=', $request->id)->first();

        return new static(
            user_id: auth('sanctum')->user()->getAuthIdentifier(),
            status: ! empty($request->status) ? $request->status : $task->status,
            priority: ! empty($request->priority) ? $request->priority : $task->priotity,
            title: ! empty($request->title) ? $request->title : $task->title,
            description: ! empty($request->description) ? $request->description : $task->description,
            parent_id: ! empty($request->parent_id) ? $request->parent_id : $task->parent_id,
            completed_at: (! empty($request->status) && $request->status == TaskStatusEnum::DONE->value) ? Carbon::now() : null
        );
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string|null
     */
    public function getCompletedAt(): ?string
    {
        return $this->completed_at;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
