<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Task::latest('id')->paginate();
        return view('admin.task.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        return view('admin.task.create', compact('teams', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'nullable|string',
            'team_id' => 'required|exists:teams,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in_progress,done',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);


        Task::create([
            'name' => $request->name,
            'body' => $request->body,
            'team_id' => $request->team_id,
            'assigned_to' => $request->assigned_to,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);


        return redirect()->route('admin.task.index')->with('msg', 'Task created successfully.')
            ->with('type', 'success');
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
    public function edit(Task $task)
    {
        $teams = Team::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();

        return view('admin.task.edit', compact('teams', 'task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'nullable|string',
            'team_id' => 'required|exists:teams,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in_progress,done',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'name' => $request->name,
            'body' => $request->body,
            'team_id' => $request->team_id,
            'assigned_to' => $request->assigned_to,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);


        return redirect()->route('admin.task.index')->with('msg', 'Task updated successfully.')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.task.index')->with('msg', 'Task deleted successfully.')
            ->with('type', 'danger');
    }
}
