@extends('layouts.app')

@section('content')
<main>
  <div class="content">
                <div>
                    <img src="data:image/png;base64,{{ $user->social_icon }}" width="100" height="100">
                    {{ $user->social_account }}
                </div>
                <div>
                    @foreach ($user->posts()->orderBy('created_at', 'DESC')->get() as $post)
                        <img src="data:image/png;base64,{{ $post->image }}" width="240" height="240">
                    @endforeach
                </div>
</div>
</main>

@endsection
