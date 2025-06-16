<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
    <!--  <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            投稿詳細
        </h2>
     <?php $__env->endSlot(); ?> -->

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 新規投稿ボタン（画面上部に移動すると使いやすいです） -->
             <?php if(auth()->guard()->check()): ?>
            <div class="flex justify-end">
                <a href="<?php echo e(route('posts.create')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    新規投稿
                </a>
            </div>
             <?php endif; ?>
            <!-- 投稿詳細 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100"><?php echo e($post->title); ?></h3>
                    <p class="text-sm font-normal text-gray-900 dark:text-gray-100">投稿日時: <?php echo e($post->created_at->format('Y年m月d日 H:i')); ?></p>

                    
                    <p class="mt-4 text-gray-600 dark:text-gray-400 whitespace-pre-wrap"><?php echo e($post->content); ?></p>

                    <!-- 操作ボタン -->
                    <div class="mt-6 flex items-center space-x-4">
                        
                        <a href="<?php echo e(route('posts.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            一覧へ戻る
                        </a>
                        
                        <?php if(Auth::check() && Auth::id() === $post->user_id): ?>
                            <a href="<?php echo e(route('posts.edit', $post->id )); ?>" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                編集
                            </a>
                            <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    削除
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center mt-4">
                    <?php
                        $isLiked = $post->likes->contains('user_id', auth()->id());
                        $likedClasses = 'bg-red-500 text-white';
                        $unlikedClasses = 'text-red-500 border border-red-500 hover:bg-red-500 hover:text-white dark:text-red-400 dark:border-red-400 dark:hover:bg-red-400 dark:hover:text-white';
                    ?>
                    <button type="button" id="likeButton" 
                            class="rounded-full h-8 w-8 flex items-center justify-center transition duration-150 ease-in-out <?php echo e($isLiked ? $likedClasses : $unlikedClasses); ?>">
                        
                        
                        <svg id="icon-liked" class="h-5 w-5 <?php echo e($isLiked ? '' : 'hidden'); ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                          <path fill-rule="evenodd" d="M11.645 20.91a.75.75 0 01-1.29 0C8.636 18.252 6.545 15.63 5.093 13.193c-1.452-2.438-2.592-4.913-2.592-7.563C2.5 3.343 4.59 1.25 7.155 1.25c1.613 0 3.04.82 3.845 2.128a.75.75 0 011.29.097c.805-1.308 2.232-2.128 3.845-2.128 2.565 0 4.655 2.093 4.655 4.38c0 2.65-1.14 5.125-2.592 7.563-1.452 2.437-3.543 5.059-5.262 7.717z" clip-rule="evenodd" />
                        </svg>

                        
                        <svg id="icon-unliked" class="h-5 w-5 <?php echo e($isLiked ? 'hidden' : ''); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                    
                    
                    <p id="likeCount" class="ml-3 text-gray-700 dark:text-gray-300">
                        <span class="font-bold"><?php echo e($post->likes->count()); ?></span>件のいいね
                    </p>
                </div>
                </div>
            </div>

          
                      <!-- いいね機能 -->
            <!-- <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex items-center">
                    <?php
                        $isLiked = $post->likes->contains('user_id', auth()->id());
                        $likedClasses = 'bg-red-500 text-white';
                        $unlikedClasses = 'text-red-500 border border-red-500 hover:bg-red-500 hover:text-white dark:text-red-400 dark:border-red-400 dark:hover:bg-red-400 dark:hover:text-white';
                    ?>
                    <button type="button" id="likeButton" class="rounded-full p-2 leading-none transition duration-150 ease-in-out <?php echo e($isLiked ? $likedClasses : $unlikedClasses); ?>">
                        
                        <svg id="icon-liked" ... > ... </svg>
                        
                        <svg id="icon-unliked" ... > ... </svg>
                    </button>
                    
                    
                    <p id="likeCount" class="ml-3 text-gray-700 dark:text-gray-300">
                        <span class="font-bold"><?php echo e($post->likes->count()); ?></span>件のいいね
                    </p>
                </div>
            </div> -->

            <!-- コメント一覧 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    コメント一覧
                </h3>
                <div class="mt-6 space-y-6">
                    <?php if($comments->isEmpty()): ?>
                        <p class="text-gray-500 dark:text-gray-400">まだコメントはありません。</p>
                    <?php else: ?>
                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <p class="text-gray-800 dark:text-gray-200"><?php echo e($comment->content); ?></p>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    投稿者：<?php echo e($comment->user->name); ?> | 投稿日：<?php echo e($comment->created_at->format('Y-m-d H:i')); ?>

                                </p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- コメントフォーム -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    コメントを投稿する
                </h3>
                <div class="mt-6">
                    <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('comments.store', $post->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
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
                    <?php else: ?>
                        <p class="text-gray-500 dark:text-gray-400">
                            コメントを投稿するには<a href="<?php echo e(route('login')); ?>" class="text-indigo-500 hover:underline">ログイン</a>してください。
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ページネーション -->
            <div class="mt-4">
                <?php echo e($comments->links()); ?>

            </div>

        </div>
    </div>

    
        <?php $__env->startPush('scripts'); ?>
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
                        url: "<?php echo e(route('posts.like', $post->id)); ?>",
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
                                window.location.href = "<?php echo e(route('login')); ?>";
                            } else {
                                alert('エラーが発生しました。');
                            }
                        }
                    });
                });
            });
        }
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /Volumes/Extreme SSD/work-site_pro/test_site/bbs-app/resources/views/posts/show.blade.php ENDPATH**/ ?>