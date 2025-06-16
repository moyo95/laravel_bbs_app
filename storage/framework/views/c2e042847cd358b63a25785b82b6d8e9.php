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
    
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            掲示板一覧
        </h2>
     <?php $__env->endSlot(); ?>

    
    <div class="py-12">
         
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    
                    
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">掲示板一覧</h2>
                        <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('posts.create')); ?>" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            新規投稿
                        </a>
                        <?php endif; ?>
                    </div>
                        
                    
                    <form action="<?php echo e(route('posts.index')); ?>" method="GET" class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">検索</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <select name="search_type" class="w-1/3 rounded-l-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <option value="partial" <?php echo e(request('search_type') == 'partial' ? 'selected' : ''); ?>>部分一致</option>
                                        <option value="prefix" <?php echo e(request('search_type') == 'prefix' ? 'selected' : ''); ?>>前方一致</option>
                                        <option value="suffix" <?php echo e(request('search_type') == 'suffix' ? 'selected' : ''); ?>>後方一致</option>
                                    </select>
                                    <input type="text" name="search" id="search" class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" placeholder="キーワード" value="<?php echo e(request('search')); ?>">
                                </div>
                            </div>
                            
                            <div>
                                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300">並び順</label>
                                <select name="sort" id="sort" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                    <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>新しい順</option>
                                    <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>古い順</option>
                                    <option value="title_asc" <?php echo e(request('sort') == 'title_asc' ? 'selected' : ''); ?>>タイトル昇順</option>
                                    <option value="title_desc" <?php echo e(request('sort') == 'title_desc' ? 'selected' : ''); ?>>タイトル降順</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                検索・ソート
                            </button>
                        </div>
                    </form>

                    
                    <div class="space-y-4">
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-6 bg-white dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg">
                                <h3 class="text-lg font-bold"><?php echo e($post->title); ?></h3>
                                <p class="text-sm font-normal text-gray-900 dark:text-gray-100">投稿日時: <?php echo e($post->created_at->format('Y年m月d日 H:i')); ?></p>
                                <p class="mt-2 text-gray-600 dark:text-gray-400"><?php echo e(Str::limit($post->content, 100)); ?></p>
                                 
                                <div class="mt-6 text-right">
                                    <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        詳細を見る →
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    
                    <div class="mt-6">
                        <?php echo e($posts->appends(request()->query())->links()); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /Volumes/Extreme SSD/work-site_pro/test_site/bbs-app/resources/views/posts/index.blade.php ENDPATH**/ ?>