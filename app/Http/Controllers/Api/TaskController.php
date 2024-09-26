<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\Api\Task\CreateRequest;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
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

    public function update(CreateRequest $createRequest, $id)
    {
        // Tìm task theo id
        $task = Task::find($id);

        // Nếu không tìm thấy $task, trả về thông báo lỗi
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Cập nhật dữ liệu sau khi validate thành công
        $validatedData = $createRequest->validated();

        // Cập nhật name
        if (isset($validatedData['name'])) {
            $task->name = $validatedData['name'];
        }

        // Cập nhật description
        if (isset($validatedData['description'])) {
            $task->description = $validatedData['description'];
        }

        // Lưu lại thay đổi vào database
        $task->save();

        // Trả về response sau khi update thành công
        return response()->json([
            'message' => 'Task updated successfully', // Sửa thông điệp
            'data' => new TaskResource($task) // Trả về dữ liệu task đã cập nhật
        ], 200);
    }
}
