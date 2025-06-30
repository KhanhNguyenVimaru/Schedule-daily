<?php

namespace App\Http\Controllers;

use App\Models\task_by_day;
use App\Http\Requests\Storetask_by_dayRequest;
use App\Http\Requests\Updatetask_by_dayRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tasks;
use App\Models\Status;
use Carbon\Carbon;


class TaskByDayController extends Controller
{
    public function autoSaveTasks()
    {
        $now = Carbon::now();
        $yesterday = $now->copy()->subDay();

        // task base mới
        $newBaseTasks = Tasks::where('id', Auth::id())
            ->where('startTime', '<=', $now)
            ->where('endTime', '>=', $now)
            ->get();

        // tasks theo ngày cũ 
        $prevBaseTasks = task_by_day::join('tasks', 'task_by_days.task_id', '=', 'tasks.id')
            ->where('task_by_days.user_id', Auth::id())
            ->where('tasks.startTime', '<=', $yesterday)
            ->where('tasks.endTime', '>=', $yesterday)
            ->select('task_by_days.*', 'tasks.*')
            ->get();

        // status của ngày mới 
        $newStatus = new Status();
        $newStatus->execution_date = $now;
        $newStatus->user_id = Auth::id();
        $newStatus->save();

        // insert tasks theo ngày mới 
        foreach ($newBaseTasks as $newbase) {
            $newTasksDay = new task_by_day();
            $newTasksDay->user_id = Auth::id();
            $newTasksDay->status_id = $newStatus->id;
            $newTasksDay->task_id = $newbase->id;
            $newTasksDay->task_score = 5;
            $newTasksDay->user_score = 0;

            $newTasksDay->save();
        }

        // tính điểm
        $total_score = 0;
        $user_score = 0;
        foreach ($prevBaseTasks as $prevbase){
            $total_score = $total_score + $prevbase->task_score;
            $user_score = $user_score + $prevbase->user_score;
        }

        // update điểm 
        $updateTask = Tasks::findOrFail(Auth::id());
        if($user_score == 0){
            $updateTask->average_score = null;
        }else{
            $updateTask->average_score = $total_score/$user_score;
        }
        $updateTask->save();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Storetask_by_dayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(task_by_day $task_by_day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task_by_day $task_by_day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatetask_by_dayRequest $request, task_by_day $task_by_day)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task_by_day $task_by_day)
    {
        //
    }
}
