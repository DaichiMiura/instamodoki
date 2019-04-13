@extends('layouts.app')

@section ('title', '投稿一覧')

@section('content')
<main>
    <div class="content">
        <p>いいねをした人</p>
        @foreach ($likes as $like)
            <a class="content-icon" href="{{ route('profile', ['user_id' => $like->user_id]) }}">
                <img src="data:image/png;base64,{{ $like->user->social_icon }}" width="30" height="30">
            </a>
            <a class="content-account" href="{{ route('profile', ['user_id' => $like->user_id]) }}">
                {{ $like->user->social_account }}
            </a>
        @endforeach
    </div>
</main>
@endsection
