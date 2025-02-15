<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|unique:tasks,title',
            'content'  => 'nullable|string',
            'status'   => 'required|in:0,1,2',  // 0:todo, 1:doing, 2:done
            'deadline' => 'nullable|date',
        ]);

        $task = Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.show', $task)->with('notice', 'Task was successfully created.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('home')->with('alert', 'Forbidden access.');
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('home')->with('alert', 'Forbidden access.');
        }

        $validated = $request->validate([
            'title'    => "required|unique:tasks,title,{$task->id}",
            'content'  => 'nullable|string',
            'status'   => 'required|in:0,1,2',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.show', $task)->with('notice', 'Task was successfully updated.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('home')->with('alert', 'Forbidden access.');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('notice', 'Task was successfully deleted.');
    }
}
