<x-app-layout>
    {{-- ページ上部のヘッダー部分 --}}
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            投稿詳細
        </h2>
    </x-slot> -->

    {{-- メインコンテンツ --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 新規投稿ボタン（画面上部に移動すると使いやすいです） -->
             @auth
            <div class="flex justify-end">
                <a href="{{ route('posts.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    新規投稿
                </a>
            </div>
             @endauth
            <!-- 投稿詳細 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    {{-- タイトル --}}
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $post->title }}</h3>
                    <p class="text-sm font-normal text-gray-900 dark:text-gray-100">投稿日時: {{ $post->created_at->format('Y年m月d日 H:i') }}</p>

                    {{-- 投稿内容（whitespace-pre-wrapで改行を反映） --}}
                    <p class="mt-4 text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $post->content }}</p>

                    <!-- 操作ボタン -->
                    <div class="mt-6 flex items-center space-x-4">
                        {{-- 戻るボタン --}}
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            一覧へ戻る
                        </a>
                        {{-- 編集・削除ボタン（投稿者のみ表示） --}}
                        @if(Auth::check() && Auth::id() === $post->user_id)
                            <a href="{{ route('posts.edit', $post->id ) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                編集
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    削除
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="flex items-center mt-4">
                    @php
                        $isLiked = $post->likes->contains('user_id', auth()->id());
                        $likedClasses = 'bg-red-500 text-white';
                        $unlikedClasses = 'text-red-500 border border-red-500 hover:bg-red-500 hover:text-white dark:text-red-400 dark:border-red-400 dark:hover:bg-red-400 dark:hover:text-white';
                    @endphp
                    <button type="button" id="likeButton" 
                            class="rounded-full h-8 w-8 flex items-center justify-center transition duration-150 ease-in-out {{ $isLiked ? $likedClasses : $unlikedClasses }}">
                        
                        {{-- いいね済みのアイコン (正しい塗りつぶしハート) --}}
                        <svg id="icon-liked" class="h-5 w-5 {{ $isLiked ? '' : 'hidden' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                          <path fill-rule="evenodd" d="M11.645 20.91a.75.75 0 01-1.29 0C8.636 18.252 6.545 15.63 5.093 13.193c-1.452-2.438-2.592-4.913-2.592-7.563C2.5 3.343 4.59 1.25 7.155 1.25c1.613 0 3.04.82 3.845 2.128a.75.75 0 011.29.097c.805-1.308 2.232-2.128 3.845-2.128 2.565 0 4.655 2.093 4.655 4.38c0 2.65-1.14 5.125-2.592 7.563-1.452 2.437-3.543 5.059-5.262 7.717z" clip-rule="evenodd" />
                        </svg>

                        {{-- 未いいねのアイコン (枠線ハート) --}}
                        <svg id="icon-unliked" class="h-5 w-5 {{ $isLiked ? 'hidden' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                    {{-- ▲▲▲ ここまで ▲▲▲ --}}
                    
                    <p id="likeCount" class="ml-3 text-gray-700 dark:text-gray-300">
                        <span class="font-bold">{{ $post->likes->count() }}</span>件のいいね
                    </p>
                </div>
                </div>
            </div>

          
                      <!-- いいね機能 -->
            <!-- <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex items-center">
                    @php
                        $isLiked = $post->likes->contains('user_id', auth()->id());
                        $likedClasses = 'bg-red-500 text-white';
                        $unlikedClasses = 'text-red-500 border border-red-500 hover:bg-red-500 hover:text-white dark:text-red-400 dark:border-red-400 dark:hover:bg-red-400 dark:hover:text-white';
                    @endphp
                    <button type="button" id="likeButton" class="rounded-full p-2 leading-none transition duration-150 ease-in-out {{ $isLiked ? $likedClasses : $unlikedClasses }}">
                        
                        <svg id="icon-liked" ... > ... </svg>
                        
                        <svg id="icon-unliked" ... > ... </svg>
                    </button>
                    {{-- ▲▲▲ ここまで ▲▲▲ --}}
                    
                    <p id="likeCount" class="ml-3 text-gray-700 dark:text-gray-300">
                        <span class="font-bold">{{ $post->likes->count() }}</span>件のいいね
                    </p>
                </div>
            </div> -->

            <!-- コメント一覧 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    コメント一覧
                </h3>
                <div class="mt-6 space-y-6">
                    @if ($comments->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">まだコメントはありません。</p>
                    @else
                        @foreach($comments as $comment)
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <p class="text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    投稿者：{{ $comment->user->name }} | 投稿日：{{ $comment->created_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- コメントフォーム -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    コメントを投稿する
                </h3>
                <div class="mt-6">
                    @auth
                    <form action="{{ route('comments.store', $post->id) }}" method="POST">
                        @csrf
                        <div>
                            <label for="comment-content" class="block font-medium text-sm text-gray-700 dark:text-gray-300 sr-only">コメント内容</label>
                            <textarea name="content" id="comment-content" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" required placeholder="コメントを入力..."></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                コメント投稿
                            </button>
                        </div>
                    </form>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">
                            コメントを投稿するには<a href="{{ route('login') }}" class="text-indigo-500 hover:underline">ログイン</a>してください。
                        </p>
                    @endauth
                </div>
            </div>

            <!-- ページネーション -->
            <div class="mt-4">
                {{ $comments->links() }}
            </div>

        </div>
    </div>

    {{-- レイアウトファイル側で読み込まれるように @push を使用 --}}
        @push('scripts')
    <script>
        // このスクリプトが重複して読み込まれても問題ないように、
        // 念のため、一度だけ実行されるようにします。
        if (typeof window.likeButtonListenerAttached === 'undefined') {
            window.likeButtonListenerAttached = true;

            $(document).ready(function() {
                // いいねボタンのクリックイベントを設定
                $('#likeButton').on('click', function(e) {
                    e.preventDefault();
                    
                    const button = $(this);
                    const likeCountElement = $('#likeCount span');
                    const iconLiked = $('#icon-liked');
                    const iconUnliked = $('#icon-unliked');

                    $.ajax({
                        url: "{{ route('posts.like', $post->id) }}",
                        method: 'POST',
                        data: {},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType: 'json',
                        
                        success: function(data) {
                            if (typeof data.liked !== 'undefined' && typeof data.like_count !== 'undefined') {
                                const likedClasses = 'bg-red-500 text-white';
                                const unlikedClasses = 'text-red-500 border border-red-500 hover:bg-red-500 hover:text-white dark:text-red-400 dark:border-red-400 dark:hover:bg-red-400 dark:hover:text-white';
                                
                                button.removeClass(likedClasses + ' ' + unlikedClasses);
                                button.addClass(data.liked ? likedClasses : unlikedClasses);
                                
                                iconLiked.toggleClass('hidden', !data.liked);
                                iconUnliked.toggleClass('hidden', data.liked);
                                
                                likeCountElement.text(data.like_count);
                            } else {
                                console.error("サーバーからのレスポンス形式が不正です:", data);
                            }
                        },
                        
                        error: function(xhr) {
                            console.error("AJAXリクエストでエラーが発生しました:", xhr.responseText);
                            if (xhr.status === 401) {
                                alert('いいねをするにはログインが必要です。');
                                window.location.href = "{{ route('login') }}";
                            } else {
                                alert('エラーが発生しました。');
                            }
                        }
                    });
                });
            });
        }
    </script>
    @endpush
</x-app-layout>