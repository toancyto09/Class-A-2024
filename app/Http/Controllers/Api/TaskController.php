<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
       return response()->json(data:['massage'=>'hello would']);
    }

    public function store(CreateRequest $createRequest): JsonResource|JsonResponse
    {
        // Xác thực và lấy dữ liệu đã xác thực
        $request = $createRequest->validated();

        // Tạo nhiệm vụ mới thông qua TaskService
        $result = $this->taskService->create($request);

        // Kiểm tra kết quả trả về
        if ($result) {
            return new TaskResource($result);
            
        }

        // Trả về phản hồi lỗi nếu không thể tạo nhiệm vụ
        return response()->json([
            'message' => 'Đã xảy ra lỗi khi tạo nhiệm vụ',
        ]);
    }
    
    //Task $task đoạn này laravel xử lý yêu tìm đối tượng Task có ID trong csdl gán vào $task
    public function show(Task $task)
    {
        return new TaskResource($task);
    }



    
    //BTVN function update and delete

    public function update(CreateRequest $createRequest, $idtask)
    {

        $request = $createRequest->validated();
        $result = $this->taskService->update($request, $idtask);
        if($result)
            return new TaskResource($result);
        return response()->json([
            'message' => 'Đã xảy ra lỗi khi tạo nhiệm vụ'
        ]);

    }

    public function delete($idtask){
    
        $result = $this->taskService->delete($idtask);
        if($result)
            return response()->json([
                'message' => 'Đã xóa thành công'
            ]);
        return response()->json([
            'message' => 'Đã xảy ra lỗi khi tạo nhiệm vụ'
        ]);

    }
}