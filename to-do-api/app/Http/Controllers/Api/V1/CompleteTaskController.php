<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Task $task)
    {
        $validator = Validator::make(
            $request->all(),
            ['is_completed' => "required|boolean"]
        );

        if($validator->fails()) {
            return TaskResource::make($validator->validated());
        }
        $task->is_completed = $request->is_completed;
        $task->save();

        return TaskResource::make($task);
    }
}
