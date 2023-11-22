<?php

namespace App\Http\Requests;

use App\Rules\TaskUserRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskCreateRequest',
    title: 'TaskCreateRequest',
    description: 'TaskCreateRequest',
    required: ['priority', 'title'],
    properties: [
        new OA\Property(property: 'priority', type: 'integer', maximum: 5, minimum: 1, example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'Title'),
        new OA\Property(property: 'description', type: 'string', example: 'Description', nullable: true),
        new OA\Property(property: 'parent_id', type: 'integer', example: 1, nullable: true)
    ],
)]
class TaskCreateRequest extends FormRequest
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
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'string'],
            'description' => ['sometimes', 'string', 'nullable'],
            'parent_id' => ['integer', 'nullable', 'sometimes', 'exists:tasks,id', new TaskUserRule()],
        ];
    }
}
