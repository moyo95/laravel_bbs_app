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
            トップページ
        </h2>
     <?php $__env->endSlot(); ?>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    
                    
                    <h2 class="text-3xl font-bold mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                        トップページ
                    </h2>

                    <!-- <?php if(isset($posts) && $posts->count() > 0): ?>
                        <div class="space-y-6">
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-6 bg-white dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300">
                                    
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        <?php echo e($post->title); ?>

                                    </h3>
                                    
                                    
                                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                                        <?php echo e(Str::limit($post->content, 200)); ?>

                                    </p>
                                    
                                    
                                    <div class="mt-6 flex justify-between items-center text-sm text-gray-500 dark:text-gray-400">
                                        <span>
                                            投稿者: <strong><?php echo e($post->user?->name ?? '不明'); ?></strong>
                                        </span>
                                        <span>
                                            投稿日時: <?php echo e($post->created_at->format('Y/m/d H:i')); ?>

                                        </span>
                                    </div>
                                    
                                    
                                    <div class="mt-6 text-right">
                                        <a href="<?php echo e(route('posts.show', $post)); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            詳細を見る
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <div class="mt-8">
                            <?php echo e($posts->links()); ?>

                        </div>
                    <?php else: ?>
                        <p class="text-center text-gray-500">投稿はまだありません。</p>
                    <?php endif; ?> -->
                    
                    
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
<?php endif; ?><?php /**PATH /Volumes/Extreme SSD/work-site_pro/test_site/bbs-app/resources/views/welcome.blade.php ENDPATH**/ ?>