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

    public function update($params, $idtask){
        try{
            $task = $this->model::find($idtask);
            if(!$task)
                return false;
            $task->update($params);
            return $task;
        }catch(Exception $exception){
            Log::error($exception);

            return false;
        }
    }

    public function delete($idtask)
    {
        try{
            $task = $this->model::find($idtask);
            if(!$task)
                return false;
                       
            return $task->delete($task);
        }catch(Exception $exception){
            log::error($exception);
            
            return false;
        }
    }
}
