<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StatusResource',
    title: 'StatusResource',
    description: 'Status Resource',
    properties: [
        new OA\Property(property: 0, type: 'string', example: 'todo'),
        new OA\Property(property: 1, type: 'string', example: 'done')
    ],
)]
class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
