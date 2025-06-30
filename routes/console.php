<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;    

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// SCHEDULE 
Schedule::call(function () {
    app(\App\Http\Controllers\TaskByDayController::class)->autoSaveTasks();
})->dailyAt('12:00');
