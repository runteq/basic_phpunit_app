@extends('layouts.app')

@section('title', 'タスク詳細')

@section('content')
    <h1>タスク詳細</h1>
    @if(session('notice'))
        <div class="alert alert-success">
            {{ session('notice') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $task->title }}</h3>
            <p class="card-text">{{ $task->content }}</p>
            <p><strong>ステータス:</strong>
                @if($task->status == 0)
                    Todo
                @elseif($task->status == 1)
                    Doing
                @else
                    Done
                @endif
            </p>
            <p><strong>期限:</strong> {{ $task->deadline ? $task->deadline->format('Y-m-d H:i') : '-' }}</p>
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">編集</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('削除してもよろしいですか？')">削除</button>
            </form>
        </div>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-link mt-3">タスク一覧に戻る</a>
@endsection
