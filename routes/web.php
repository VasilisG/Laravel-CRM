<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  Route::get('/', DashboardController::class);
  Route::get('dashboard', DashboardController::class);
  Route::resource('clients',  ClientController::class,  ['except' => [ 'show' ]])->middleware('can:clients');
  Route::resource('projects', ProjectController::class, ['except' => [ 'show' ]])->middleware('can:projects');
  Route::resource('tasks',    TaskController::class,    ['except' => [ 'show' ]])->middleware('can:tasks');
  Route::resource('users',    UserController::class,    ['except' => [ 'show' ]])->middleware('can:users');
  Route::resource('roles',    RoleController::class,    ['except' => [ 'show' ]])->middleware('can:roles');
});

require __DIR__ . '/auth.php';