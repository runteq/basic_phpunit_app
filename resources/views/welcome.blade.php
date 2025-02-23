<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>システムテスト課題 サンプルアプリ</h1>
        <p>このアプリは、システムスペックに基づいたテストケースの検証用サンプルアプリです。</p>
        <p>簡単なタスク管理機能とユーザー管理機能を実装しており、ログイン、ユーザー登録、タスクの新規作成・編集・削除などの動作を確認できます。</p>
        <p>以下のボタンからログインまたはユーザー登録を行って、各機能をお試しください。</p>
        <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">ユーザー登録</a>
    </div>
</body>
</html>
