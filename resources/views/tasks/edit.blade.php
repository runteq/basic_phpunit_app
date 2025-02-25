@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control">{{ old('content', $task->content) }}</textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="0" {{ old('status', $task->status) == '0' ? 'selected' : '' }}>Todo</option>
                <option value="1" {{ old('status', $task->status) == '1' ? 'selected' : '' }}>Doing</option>
                <option value="2" {{ old('status', $task->status) == '2' ? 'selected' : '' }}>Done</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="{{ old('deadline', optional($task->deadline)->format('Y-m-d\TH:i')) }}">
            @error('deadline')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
@endsection

