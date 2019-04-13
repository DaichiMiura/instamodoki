@extends('layouts.app')

@section('title', '投稿')

@section('content')
<main>
    <div class="content">
        <div class="form">
            <form action="{{ route('add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p>画像をアップロードして下さい。</p>
                @if ($errors->has('image'))
                    @foreach ($errors->get('image') as $error)
                        <p class="error">{{ $error }}</p>
                    @endforeach
                @endif
                <p><input type="file" id="file" name="image" value="{{ old('image') }}" accept="image/*"></p>
                <img id="preview">
                <p>キャプションを入力して下さい。(200文字以内)</p>
                @if ($errors->has('caption'))
                    @foreach ($errors->get('caption') as $error)
                        <p class="error">{{ $error }}</p>
                    @endforeach
                @endif

                <textarea name="caption" rows="5" cols="70" value="{{ old('caption') }}"></textarea>
                <p><input type="submit" value="送信"></p>
            </form>
        </div>
    </div>
</main>

<script>
    const file = document.getElementById('file');
    file.addEventListener('change', function(e) {
        const image = e.target.files[0];
        const url   = window.URL.createObjectURL(image);
        const img   = document.getElementById('preview');
        img.src   = url;
        img.width = '500';
    });
</script>

@endsection
