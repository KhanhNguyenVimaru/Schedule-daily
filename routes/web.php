<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// UI
Route::get('/', function(){return view('dashboard');})->middleware('auth');
Route::get('/dashboardPage', function(){return view('dashboard');})->name('page.dashboard')->middleware('auth');
Route::get('/taskPage', function(){return view('Task');})->name('page.task')->middleware('auth');

Route::get('/loginPage', function () {return view('login'); })->name('login');
Route::get('/signupPage',function(){return view('signup');})->name('page.signup');

// API LOGIN/OUT
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
