<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks  = Tasks::where("user_id", Auth::id())->get();
        return view('Task', compact('tasks'));
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
    public function store(StoreTasksRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string|max:255',
            'duration' => 'required',
            'startTime' => 'nullable|date',
            'endTime' => 'nullable|date',
        ]);

        // Xác định duration long-term/short-term nếu là 'time'
        $duration = $request->duration;
        if ($duration === 'time') {
            if (!$request->startTime || !$request->endTime) {
                return response()->json(['error' => 'Start time and end time are required for timed tasks.'], 422);
            }
            $start = new \DateTime($request->startTime);
            $end = new \DateTime($request->endTime);
            $interval = $start->diff($end);
            $months = ($interval->y * 12) + $interval->m;
            if ($months > 6) {
                $duration = 'long-term';
            } else {
                $duration = 'short-term';
            }
        }

        $newTask = new Tasks();
        $newTask->name = $request->name;
        $newTask->detail = $request->detail;
        $newTask->duration = $duration;
        $newTask->startTime = $request->startTime;
        $newTask->endTime = $request->endTime;
        $newTask->user_id = Auth::id();
        $newTask->save();

        return response()->json(['success' => true, 'task' => $newTask]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Xác thực dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string|max:255',
            'duration' => 'required|string',
            'startTime' => 'nullable|date',
            'endTime' => 'nullable|date',
        ]);
    
        // 2. Tìm task
        $task = Tasks::findOrFail($id);
    
        // 3. Xử lý duration nếu là "time"
        $duration = $validated['duration'];
        if ($duration === 'time') {
            if (empty($validated['startTime']) || empty($validated['endTime'])) {
                return back()->withErrors(['error' => 'Start time and end time are required for timed tasks.']);
            }
    
            $start = new \DateTime($validated['startTime']);
            $end = new \DateTime($validated['endTime']);
    
            if ($start > $end) {
                return back()->withErrors(['error' => 'Start time must be before end time.']);
            }
    
            $interval = $start->diff($end);
            $months = ($interval->y * 12) + $interval->m;
    
            $duration = $months > 6 ? 'long-term' : 'short-term';
        }
    
        // 4. Cập nhật dữ liệu
        $task->name = $validated['name'];
        $task->detail = $validated['detail'] ?? null;
        $task->duration = $duration;
        $task->startTime = $validated['startTime'] ?? null;
        $task->endTime = $validated['endTime'] ?? null;
        $task->save();
    
        // 5. Chuyển hướng
        return redirect()->route('page.task')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteTask = Tasks::findOrFail($id);
        $deleteTask->delete();
        return redirect()->route('page.task');
    }
}
