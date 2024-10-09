<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskService {

    protected $model;
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function create($params)
    {
        try {
            $params['status'] = 1;
            
            return $this->model->create($params);
        } catch (Exception $exception) {
            Log::error($exception);

            return false;
        }
    }
    public function update(Task $task, array $params)
    {
        Log::info('Updating task with params:', $params);
        
        try {
            // Sử dụng fill để cập nhật các trường và sau đó save
            $task->fill($params);
            $result = $task->save();
    
            // Kiểm tra nếu cập nhật thành công
            return $result ? $task : false;
        } catch (\Exception $exception) {
            Log::error('Error occurred during task update', ['exception' => $exception]);
            return false;
        }
    } 
}    
