@extends('layouts.app')

@section('title', 'ユーザープロフィール')

@section('content')
    <h1>ユーザープロフィール</h1>

    <p><strong>Email:</strong> {{ $user->email }}</p>
    
    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">プロフィール編集</a>
@endsection

