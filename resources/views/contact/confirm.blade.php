@extends('layout')

@section('content')

<div class="col-md-8 offset-md-2">
    <h2 class="fs-1 mb-5 mt-5 text-center fw-bold">送信内容の確認</h2>
    <form action="{{ route('contact.send')}}" method="POST">
            <input type="hidden" name="name" value="{{ $contactData['name'] }}">
            <input type="hidden" name="email" value="{{ $contactData['email'] }}">
            <input type="hidden" name="message" value="{{ $contactData['message'] }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">お名前</label>
                    <p class="form-control">{{ $contactData['name'] }}</p>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                     <p class="form-control">{{ $contactData['email'] }}</p>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">メッセージ</label>
                    <p class="form-control">{{ $contactData['message'] }}</p>
                </div>
                
                <div class="text-center pt-4 col-md-6 offset-md-3">
                <button type="button" onClick="history.back()" class="btn btn-secondary">修正</button>
                <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
@endsection