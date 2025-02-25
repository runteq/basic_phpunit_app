<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
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
        ], [
            'title.required' => 'タイトルは必須です',
            'title.unique'   => 'そのタイトルは既に使用されています',
            'status.required' => 'ステータスは必須です',
        ]);

        $task = Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.show', $task)->with('notice', 'タスクが正常に作成されました');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('alert', 'Forbidden access.');
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('alert', 'Forbidden access.');
        }

        $validated = $request->validate([
            'title'    => "required|unique:tasks,title,{$task->id}",
            'content'  => 'nullable|string',
            'status'   => 'required|in:0,1,2',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.show', $task)->with('notice', 'タスクが正常に更新されました');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('alert', 'Forbidden access.');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('notice', 'タスクが正常に削除されました');
    }
}
