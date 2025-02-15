@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
    <h1>Task Details</h1>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $task->title }}</h3>
            <p class="card-text">{{ $task->content }}</p>
            <p><strong>Status:</strong>
                @if($task->status == 0)
                    Todo
                @elseif($task->status == 1)
                    Doing
                @else
                    Done
                @endif
            </p>
            <p><strong>Deadline:</strong> {{ $task->deadline ? $task->deadline->format('Y-m-d H:i') : '-' }}</p>
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-link mt-3">Back to Tasks</a>
@endsection

