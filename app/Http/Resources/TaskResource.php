<?php

namespace App\Http\Resources;

use App\Enum\TaskStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskResource',
    title: 'TaskResource',
    description: 'Task resource',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'user_id', type: 'integer', example: 1),
        new OA\Property(property: 'status', type: 'string', enum: TaskStatusEnum::class),
        new OA\Property(property: 'priority', type: 'int', example: 5),
        new OA\Property(property: 'title', type: 'string', example: 'Title'),
        new OA\Property(property: 'description', type: 'string', example: 'Description'),
        new OA\Property(property: 'completedAt', type: 'string', format: 'date', example: '01.01.2023'),
        new OA\Property(property: 'children', ref: '#/components/schemas/TaskCollection')
    ],
)]
class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at,
            'parent_id' => $this->parent_id,
            'children' => TaskCollection::make($this->children)
        ];
    }
}
