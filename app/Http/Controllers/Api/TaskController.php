<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Requests\Api\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Lấy dữ liệu đã được xác thực từ request
        $validatedData = $request->validated();
    
        // Gọi TaskService để thực hiện cập nhật task
        $result = $this->taskService->update($task, $validatedData);
    
        // Kiểm tra xem cập nhật có thành công hay không
        if ($result) {
            return new TaskResource($result); // Trả về task đã được cập nhật
        }
    
        return response()->json(['message' => 'Cập nhật không thành công'], 500);
    }
    

}
