<?php

namespace App\Http\Controllers;

use App\Dto\TaskCreateDto;
use App\Dto\TaskIndexDto;
use App\Dto\TaskUpdateDto;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskDeleteRequest;
use App\Http\Requests\TaskShowRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskWithoutChildrenResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class TaskController extends Controller
{
    /**
     * @param TaskService $taskService
     */
    public function __construct(private readonly TaskService $taskService)
    {
    }

    /**
     * Index
     * @param Request $request
     * @return TaskCollection
     */
    #[OA\Get(path: '/tasks', tags: ['tasks'])]
    #[OA\Parameter(name: 'filter', in: 'query')]
    #[OA\Parameter(name: 'sort', in: 'query')]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/TaskCollection')
    )]
    public function index(Request $request): TaskCollection
    {
        $dto = TaskIndexDto::fromRequest($request);

        return TaskCollection::make($this->taskService->getAllByUserId($dto));
    }

    /**
     * Create Task
     * @param TaskCreateRequest $request
     * @return TaskWithoutChildrenResource
     */
    #[OA\Post(path: '/tasks', tags: ['tasks'])]
    #[OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/TaskCreateRequest'))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(
        ref: '#/components/schemas/TaskWithoutChildrenResource'
    ))]
    public function create(TaskCreateRequest $request): TaskWithoutChildrenResource
    {
        $dto = TaskCreateDto::fromRequest($request);

        return TaskWithoutChildrenResource::make($this->taskService->create($dto));
    }

    /**
     * Show Task
     * @param TaskShowRequest $request
     * @return TaskResource
     */
    #[OA\Get(path: '/tasks/{task_id}', tags: ['tasks'])]
    #[OA\PathParameter(name: 'task_id', required: true)]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/TaskResource')
    )]
    public function show(TaskShowRequest $request): TaskResource
    {
        return TaskResource::make($this->taskService->getById($request->id));
    }

    /**
     * Update Task
     * @param TaskUpdateRequest $request
     * @return TaskWithoutChildrenResource
     */
    #[OA\Patch(path: '/tasks/{task_id}', tags: ['tasks'])]
    #[OA\PathParameter(name: 'task_id', required: true)]
    #[OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/TaskUpdateRequest'))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(
        ref: '#/components/schemas/TaskWithoutChildrenResource'
    ))]
    public function update(TaskUpdateRequest $request): TaskWithoutChildrenResource
    {
        $dto = TaskUpdateDto::fromRequest($request);

        return TaskWithoutChildrenResource::make($this->taskService->update($request->id, $dto));
    }

    /**
     * Delete Task
     * @param TaskDeleteRequest $request
     * @return JsonResponse
     */
    #[OA\Delete(path: '/tasks/delete/{task_id}', tags: ['tasks'])]
    #[OA\PathParameter(name: 'task_id', required: true)]
    #[OA\Response(response: 204, description: 'No content')]
    public function delete(TaskDeleteRequest $request): JsonResponse
    {
        $this->taskService->delete($request->id);

        return response()->json('', 204);
    }
}
