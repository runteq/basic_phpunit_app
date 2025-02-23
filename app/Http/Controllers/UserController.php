<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = User::create([
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('notice', '登録が完了しました');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if ($user->id !== auth()->id()) {
            return redirect()->route('users.show', auth()->user())->with('alert', 'Forbidden access.');
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id !== auth()->id()) {
            return redirect()->route('users.show', auth()->user())->with('alert', 'Forbidden access.');
        }

        $validated = $request->validate([
            'email'    => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:3|confirmed',
        ]);

        $data = ['email' => $validated['email']];
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('users.show', $user)->with('notice', 'プロフィールが更新されました');
    }

    public function destroy(User $user)
    {
        if ($user->id !== auth()->id()) {
            return redirect()->route('users.show', auth()->user())->with('alert', 'Forbidden access.');
        }
        $user->delete();
        return redirect()->route('dashboard')->with('notice', 'ユーザーが正常に削除されました');
    }
}
