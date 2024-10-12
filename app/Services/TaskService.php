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
        if (empty($params)) {
            throw new Exception('No parameters provided');
        }
        try {
            $params['status'] = 1;

            return $this->model->create($params);
        } catch (Exception $exception) {
            Log::error($exception);
            return false;
        }
    }
    public function update(Task $task, $params)
    {
        try {
            return $task->update($params);
        } catch (Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

    public function delete(Task $task)
    {
        try {
            return $task->delete();
        } catch (Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

}