<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Requests\Api\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        return response()->json(['message' => 'Hello World!!!']);
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
    public function update(UpdateRequest $updateRequest, Task $task)
    {
        try {
            $request = $updateRequest->validated();
            $result = $this->taskService->update($task->id, $request); // Thêm ID vào đây

            if ($result) {
                return new TaskResource($result);
            }

            return response()->json([
                'message' => 'error'
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }
    public function delete(Task $task)
    {
        try {
            $task->delete();

            return response()->json([
                'message' => 'Task soft deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        try {
            $task = Task::onlyTrashed()->findOrFail($id);

            $task->restore();

            return response()->json([
                'message' => 'Task restored successfully.',
                'task' => new TaskResource($task)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $task = Task::onlyTrashed()->findOrFail($id); 

            $task->forceDelete(); 
            return response()->json([
                'message' => 'Task permanently deleted.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function show(Task $task)
    {
        return new TaskResource($task);
    }
}
