<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", title: "todo list api")]
#[OA\Tag(name: 'tasks', description: 'Tasks')]
#[OA\Tag(name: 'statuses', description: 'Statuses')]
class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
