@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>ようこそ, {{ auth()->user()->name ?? 'User' }} さん</h1>

    <!-- タスク作成ボタン -->
    <div class="mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">タスク作成</a>
    </div>

    <h2>あなたのタスク一覧</h2>
    @if($tasks->isEmpty())
        <p>タスクはありません。</p>
    @else
        <ul>
            @foreach($tasks as $task)
                <li>
                    <a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

