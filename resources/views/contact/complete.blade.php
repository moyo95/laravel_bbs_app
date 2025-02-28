@extends('layout')

@section('content')

<div class="col-md-8 offset-md-2 text-center">
    <h2 class="fs-1 mb-5 mt-5 text-center fw-bold">お問合せが完了しました</h2>
    <p class="mb-3">メールが正常に送信されました</p>
    <p class="mb-3">今後とも宜しくお願いいたします。</p>
    <a href="{{ route('posts.index') }}">掲示板一覧に戻る</a>
</div>

@endsection