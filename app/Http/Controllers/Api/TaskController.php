<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Requests\Api\Task\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Providers\ResponseServiceProvider;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }

    public function index()
    {
        return response()->json(['message'=> 'Hello world !']);
    }

    public function store(CreateRequest $createRequest )
    {
        $request = $createRequest->validated();
        $result = $this->taskService->create($request);

        if ($result) {
            return response()->api_success('create success', $result);
        }

        return response()->api_error('create error');
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $validatedData = $request->validated();
        $result = $this->taskService->update($task, $validatedData);

        if ($result) {
            return response()->api_success('update success', $result);
        }
    
        return response()->api_error('update error');
    }

    public function destroy(Task $task)
    {
        $result = $this->taskService->delete($task);

        if ($result) {
            return response()->api_success('delete success');
        }

        return response()->api_error('delete error');
    }
}
