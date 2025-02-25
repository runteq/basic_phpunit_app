@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST" novalidate>
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>
@endsection

