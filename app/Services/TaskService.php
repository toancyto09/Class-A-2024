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
    public function update($params, $id){
        try{
            $task = $this->model::find($id);
            if(!$task)
                return false;
            $task->update($params);
            return $task;
        }catch(Exception $ex){
            Log::error($ex);
            return false;
        }
    }
    public function delete($id)
    {
        try{
            $task = $this->model::find($id);
            if(!$task)
                return false;
            $task->delete($task);
        }catch(Exception $ex){
            log::error($ex);
            return false;
        }
    }
    public function getAll(){
        return $this->model::all();
    }
}
