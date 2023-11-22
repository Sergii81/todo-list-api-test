<?php

namespace App\Http\Controllers;

use App\Enum\TaskStatusEnum;
use App\Http\Resources\StatusResource;
use OpenApi\Attributes as OA;

class StatusController extends Controller
{
    /**
     * Index
     * @return StatusResource
     */
    #[OA\Get(path: '/statuses', tags: ['statuses'])]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(
        ref: '#/components/schemas/StatusResource'
    ))]
    public function index(): StatusResource
    {
        return StatusResource::make(TaskStatusEnum::cases());
    }
}
