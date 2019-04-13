<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <ul>
        <li><a href="{{ route('home') }}">ホーム</a></li>
        @guest
          <li><a href="{{ route('login') }}">ログイン</a></li>
        @else
          <li><a href="{{ route('logout') }}">ログアウト</a></li>
        @endguest
        <li><a href="{{ route('add') }}">投稿</a></li>
    </ul>
</header>
@yield('content')
</body>
</html>
