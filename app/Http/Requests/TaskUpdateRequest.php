<?php

namespace App\Http\Requests;

use App\Enum\TaskStatusEnum;
use App\Rules\TaskUserRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskUpdateRequest',
    title: 'TaskUpdateRequest',
    description: 'TaskUpdateRequest',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'todo', nullable: null),
        new OA\Property(property: 'priority', type: 'integer', maximum: 5, minimum: 1, example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'Title'),
        new OA\Property(property: 'description', type: 'string', example: 'Description', nullable: true),
        new OA\Property(property: 'parent_id', type: 'integer', example: 1, nullable: true)
    ],
)]

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tasks,id', new TaskUserRule()],
            'status' => ['sometimes', 'string', 'nullable', Rule::enum(TaskStatusEnum::class)],
            'priority' => ['sometimes', 'integer', 'min:1', 'max:5', 'nullable'],
            'title' => ['sometimes', 'string', 'nullable'],
            'description' => ['sometimes', 'string', 'nullable'],
            'parent_id' => ['integer', 'nullable', 'sometimes', 'exists:tasks,id', new TaskUserRule()],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('task')
        ]);
    }
}
