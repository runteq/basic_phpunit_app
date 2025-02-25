<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // ログインしていないユーザーには、create と store を除いてアクセス不可にする
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
            'name'     => 'required',
        ], [
            'email.required'    => 'メールアドレスは必須です',
            'password.required' => 'パスワードは必須です',
            'name.required'     => '名前は必須です',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('notice', '登録が完了しました');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // 既存の edit, update, destroy はそのまま利用

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
            'name'     => 'required',
        ]);

        $data = [
            'email' => $validated['email'],
            'name'  => $validated['name'],
        ];
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

    public function mypage()
    {
        $user = auth()->user();
        // ここでは users.show ビューを流用してもよいですが、専用ビューを作成してもよいです
        return view('users.mypage', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }
}

