@extends('layouts.app')

@section ('title', '投稿一覧')

@section('content')
<main>
    @foreach ($posts as $post)
        <div class="content">
            <div class="content-poster">
                <a class="content-icon" href="{{ route('profile', [
                    'user_id' => $post->user_id
                ]) }}">
                    <img src="data:image/png;base64,{{ $post->user->social_icon }}" width="30" height="30">
                </a>
                <a class="content-account" href="{{ route('profile', [
                    'user_id' => $post->user_id
                ]) }}">
                    {{ $post->user->social_account }}
                </a>
                @if ($post->user_id === Auth::id())
                    <div class="content-delete">
                        <form method="post" action="{{ route('home') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input class="delete-button" type="submit" value="投稿を削除">
                        </form>
                    </div>
                @endif
            </div>
            <img class="content-image" src="data:image/png;base64,{{ $post->image }}" width="550">
            <div class="content-footer">
                <div class="content-good">
                    @guest
                        <p><a href="{{ route('login') }}" class="good-button">いいね！</a></p>
                    @else
                        @if ($post->likes()->where('user_id', Auth::id())->exists())
                            <form method="post" action="{{ route('push_like', ['post_id' => $post->id]) }}">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input class="good-button" type="submit" value="いいね解除">
                            </form>
                        @else
                            <form method="post" action="{{ route('push_like', ['post_id' => $post->id]) }}">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input class="good-button" type="submit" value="いいね！">
                            </form>
                        @endif
                    @endguest
                    <p><a class="good-users" href="{{ route('likes', ['post_id' => $post->id]) }}">いいねしたユーザー</a></p>
                </div>
                <div class="content-caption">
                    <p>{{ $post->caption }}</p>
                    <p>{{ $post->formatted_date}}</p>
                </div>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
</main>
@endsection
