<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class);

Route::get('/login', function(){
  return view('auth.login');
});

Route::resource('clients',  ClientController::class,  ['except' => [ 'show' ]]);
Route::resource('projects', ProjectController::class, ['except' => [ 'show' ]]);
Route::resource('tasks',    TaskController::class,    ['except' => [ 'show' ]]);
Route::resource('users',    UserController::class,    ['except' => [ 'show' ]]);
Route::resource('roles',    RoleController::class,    ['except' => [ 'show' ]]);