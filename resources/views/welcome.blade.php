<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Laravel サンプルアプリ</h1>
        <!-- 明示的に「Laravel」を表示 -->
        <p>Laravel</p>
        <p>このアプリは、システムスペックに基づいたテストケースの検証用サンプルアプリです。<br>
           簡単なタスク管理機能とユーザー管理機能を実装しています。</p>
        <p>以下のボタンからログインまたはユーザー登録を行って、各機能をお試しください。</p>
        <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">ユーザー登録</a>
    </div>
</body>
</html>
