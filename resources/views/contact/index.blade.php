@extends('layout')

@section('content')

    <!-- <form action="{{ route('contact.confirm')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" name="name" id="name" class="form-contro" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="text" name="email" id="email" class="form-contro" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">メッセージ</label>
            <textarea name="message" id="message" class="form-contro" row="5" required>{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">確認</button>
    </form> -->


    <div class="col-md-8 offset-md-2">
            <h2 class="fs-1 mb-5 mt-5 text-center fw-bold">お問い合わせ</h2>
            <form action="{{ route('contact.confirm')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="名前（必須）" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" name="email" id="email" placeholder="メールアドレス（必須）" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <textarea class="form-control" name="message" id="message" rows="5" placeholder="メッセージを入力してください">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="text-danger">{{ $errors->first('message') }}</div>
                    @enderror
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                      利用規約に同意します。<a href="" target="_blank" rel="noopener noreferrer" class="text-decoration-underline text-dark">プライバシーポリシーはこちら</a>
                    </label>
                  </div>
                <div class="text-center pt-4 col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">確認</button>
                </div>
            </form>
        </div>
@endsection