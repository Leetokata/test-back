<?php

namespace App\Services;

use DB;
use App\Models\Task;

use App\Traits\ApiResponser;
use App\Repositories\Task\TaskRepository;

class TaskServices {

    use ApiResponser;

    public $repository;

    /**
     * constructos
     */
    public function __construct() {
        $this->repository = new TaskRepository(new Task);
    }

    /**
     * list task
     * @param string $perPage
     * @param string $search
    */
    public function listTask($perPage, $search) {
        try {
            return $this->successResponse([
                'success' => true,
                'data' => $this->repository->listTask($perPage, $search)
            ]);

        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

    /**
     * Save task
     * @param array $params
     */
    public function saveTask($params) {
        try {
            $task = Task::create(array_merge($params, ["status" => "pendiente"]));
            return $this->successResponse([
                'success' => true,
                'data' => $task,
                'message' => 'Se ha creado la tarea correctamente'
            ]);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }


    /**
     * update task
     * @param array $params
     */
    public function updateTask($params, Task $task) {
        try {
            $task->update($params);
            return $this->successResponse([
                'success' => true,
                'data' => $task,
                'message' => 'Se actualizó la tarea correctamente'
            ]);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

     /**
     * update status task
     * @param string $status
     */
    public function updateTaskStatus($status, Task $task) {
        try {
            $task->update([
                "status" => $status
            ]);
            return $this->successResponse([
                'success' => true,
                'data' => $task,
                'message' => 'Se actualizó la tarea correctamente'
            ]);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

    /**
     * delete task
     * @param array $params
     */
    public function deleteTask(Task $task) {
        try {

            $task->delete();

            return $this->successResponse([
                'success' => true,
                'message' => 'Se ha eliminado la tarea correctamente'
            ]);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

}
