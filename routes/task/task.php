<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    TaskController,
};

//Other routes with task
Route::put('task/{task}/status', [TaskController::class, 'updateStatus']);
Route::resource('task', TaskController::class);
