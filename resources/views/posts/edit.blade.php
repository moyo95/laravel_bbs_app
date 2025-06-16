<x-app-layout>
    {{-- ページヘッダー部分 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('投稿を編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    {{-- エラーがある場合に表示 --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">エラー！</strong>
                            <span class="block sm:inline">入力内容に問題があります。</span>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT') {{-- 更新の場合はPUTメソッドを指定 --}}

                        <!-- タイトル -->
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                タイトル <span class="text-red-500">(必須)</span>
                            </label>
                            <input id="title" name="title" type="text" value="{{ old('title', $post->title) }}" required autofocus
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- 投稿内容 -->
                        <div class="mt-4">
                            <label for="content" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                内容 <span class="text-red-500">(必須)</span>
                            </label>
                            <textarea id="content" name="content" rows="10" required
                                      class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('content', $post->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- ボタン -->
                        <div class="flex items-center justify-end mt-4 space-x-4">
                            <a href="{{ route('posts.show', $post->id) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 ...">
                                キャンセル
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white ...">
                                更新する
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>