<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskByDayController;
use Illuminate\Console\View\Components\Task;

// UI
Route::get('/', function(){return view('dashboard');})->middleware('auth');
Route::get('/dashboardPage', function(){return view('dashboard');})->name('page.dashboard')->middleware('auth');
Route::get('/taskPage', [TasksController::class, 'index'])->name('page.task');

Route::get('/loginPage', function () {return view('login'); })->name('login');
Route::get('/signupPage',function(){return view('signup');})->name('page.signup');

// API LOGIN/OUT
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

// API DATA
Route::post('/newTask', [TasksController::class, 'store'])->name('task.insert');
Route::delete('/delete/{id}', [TasksController::class, 'destroy'])->name('task.delete');
Route::patch('/update/{id}', [TasksController::class, 'update'])->name('task.update');


