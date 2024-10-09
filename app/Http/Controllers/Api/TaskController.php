<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Requests\Api\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }

    public function index()
    {
        return response()->json(['message' => 'Hello World!']);
    }

    public function store(CreateRequest $createRequest)
    {  
        $request = $createRequest->validated();
        $result = $this->taskService->create($request);

        if ($result) {
            return response()->api_success('create success', $result);
        }

        return response()->json([
            'message' => 'error'

        ]);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(UpdateRequest $updateRequest, Task $task)
    {
        $request = $updateRequest->validated();

        $result = $this->taskService->update($task, $request);

        if ($result) {
            // return response()->api_success('update success', true);

            return response()->json([
                'message' => 'update success'
            ], 200);
        }

        return response()->api_error('update error');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'delete success'
        ], 200);
    }
}
