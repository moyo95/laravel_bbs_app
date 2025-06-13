@extends('layout')

@section('content')
<div class="container mt-5">
     <h2>投稿詳細</h2>
     <a href="{{ route('post.create')}}" class="btn btn-primary mb-3">新規投稿</a>
          <div class="card mb-3">
               <div class="card-body">
                    <h3 class="card-title">{{ $post->title }}</h3>
                    <p class="card-text">{{ $post->content }}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
                    @if(Auth::check() && Auth::id() === $post->user_id)
                         <a href="{{ route('posts.edit', $post->id ) }}" class="btn btn-warning">編集</a>
                         <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">削除</button>
                         </form>
                    @endif
               </div>
          </div>
</div>
<div class="container d-flex align-items-center">
     {{-- いいねボタン --}}
     <button id="likeButton" class="btn {{ $post->likes->contains('user_id', auth()->id()) ? 'btn-danger' : 'btn-outline-danger' }}">
     {!! $post->likes->contains('user_id', auth()->id()) ? '<i class="bi bi-heart-fill"></i>' : '<i class="bi bi-heart"></i>' !!}
     </button>
     {{-- いいねの数 --}}
     <p id="likeCount" class="mx-2 mb-0"><span class="fs-4">{{ $post->likes->count() }}</span>件のいいね</p>
     <div>
</div>

</div>



<div class="container mt-5">
<h3>コメント一覧</h3>
@if ($comments->isEmpty())
<p>まだコメントはありません。</p>
@else
     @foreach($comments as $comment)
          <div class="card mb-2">
               <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="text-muted">投稿者：{{ $comment->user->name }} | 投稿日：{{ $comment->created_at->format('Y-m-d H:i' )}}</p>
               </div>
          </div>
     @endforeach
@endif
</div>
{{-- コメントフォーム --}}
<div class="container mt-5">
<h4>コメントを投稿する</h4>
@auth
<form action="{{ route('comments.store', $post->id) }}" method="POST">
     @csrf
     <div class="mb-3">
          <label for="content" class="form-label">コメント内容</label>
          <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
     </div>
     <button type="subumit" class="btn btn-primary">コメント投稿</button>
</form>
@else
     <p>コメントを投稿するにはログインしてください。</p>
@endauth
</div>
<div class="d-flex justify-content-center mt-4">
          {{ $comments->links() }}
</div>

{{-- javascriptで非同期通信の処理 --}}
<script>
     $(document).ready(function() {
          $('#likeButton').on('click', function(e) {
               e.preventDefault();

               const button = $(this);
               const likeCountElement = $('#likeCount');

               $.ajax({
                    url: "{{ route('posts.like', $post->id) }}",
                    method: 'POST',
                    data: {},
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                         if(data.liked) {
                              button.removeClass('btn-outline-danger').addClass('btn-danger');
                              button.html('<i class="bi bi-heart-fill"></i>');
                         }else {
                              button.removeClass('btn-danger').addClass('btn-outline-danger');
                              button.html('<i class="bi bi-heart"></i>');
                         }

                         likeCountElement.text(data.like_count + '件のいいね');
                    },
                    error: function(error) {
                         console.log('Error', error);
                    }
               });
          });
     });
</script>


@endsection