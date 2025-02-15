@extends('layouts.app')

@section('title', 'Your Tasks')

@section('content')
    <h1>Your Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Create New Task</a>
    @if($tasks->isEmpty())
        <p>No tasks found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></td>
                        <td>
                            @if($task->status == 0)
                                Todo
                            @elseif($task->status == 1)
                                Doing
                            @else
                                Done
                            @endif
                        </td>
                        <td>{{ $task->deadline ? $task->deadline->format('Y-m-d H:i') : '-' }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

