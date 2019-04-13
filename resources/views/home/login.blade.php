@extends('layouts.app')

@section('content')
<main>
    <div class="content">
    <a href="{{ route('social_login', ['social' => 'github']) }}">githubでログイン</a>
    </div>
</main>


@endsection
