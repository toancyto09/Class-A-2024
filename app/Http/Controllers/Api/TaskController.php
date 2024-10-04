<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\CreateRequest;
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
            return new TaskResource($result);
        }

        return response()->json([
            'message' => 'error'

        ]);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(CreateRequest $createRequest, $id){
        $request = $createRequest->validated();
        $result = $this->taskService->update($request, $id);
        if($result)
            return new TaskResource($result);
        return response()->json([
            'message' => 'error'
        ]);
    }
    public function delete($id)
    {
        $this->taskService->delete($id);
    }

    public function getAllTasks()
    {
        $result = $this->taskService->getAll();
        if($result)
            return TaskResource::collection($result);
        return response()->json([
            'message' => 'error'
        ]);
    }
}
