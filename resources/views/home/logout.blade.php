@extends('layouts.app')

@section('content')
<main>
    <div class="content">
        <form name="logout" method="POST" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <a href="" onclick="document.logout.submit();return false;">ログアウトする。</a>
        </form>
    </div>
</main>

@endsection
