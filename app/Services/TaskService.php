<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Exception;

class TaskService
{

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
    public function update($id, $data)
    {
        $task = $this->model->find($id);

        if (!$task) {
            return null;
        }

        $task->update($data);
        return $task;
    }

}
