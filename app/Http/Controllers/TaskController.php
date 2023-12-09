<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Task\PostRequest;
use App\Services\TaskServices;
use App\Traits\ApiResponser;
use App\Models\Task;


class TaskController extends Controller
{
    use ApiResponser;

    public $service;

    public function __construct() {
        $this->service = new TaskServices();

    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->perPage ? $request->perPage : 15;
            $search = $request->search ? $request->search : null;

           return $this->service->listTask(
                $perPage,
                $search
           );
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            //code...
           return $this->service->saveTask($request->all());
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Task $task)
    {
        try {
           return $this->service->updateTask($request->all(), $task);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

    public function updateStatus(Request $request, Task $task)
    {
        try {
            $status = $request->status ? $request->status : 'pendiente';

           return $this->service->updateTaskStatus($status, $task);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            //code...
           return $this->service->deleteTask($task);
        } catch (\Exception $e) {
            return $this->handlerException($e->getMessage());
        }
    }
}
