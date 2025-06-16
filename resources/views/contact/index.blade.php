<x-app-layout>
    {{-- ページヘッダー部分 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           お問い合わせ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">
                    
                    {{-- ▼▼▼ ここからがフォーム ▼▼▼ --}}
                    <form method="POST" action="{{ route('contact.confirm') }}"> {{-- 送信先はご自身のルートに合わせてください --}}
                        @csrf

                        <!-- 名前 -->
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300 sr-only">名前</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus placeholder="名前（必須）"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            {{-- バリデーションエラー表示 --}}
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- メールアドレス -->
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300 sr-only">メールアドレス</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="メールアドレス（必須）"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            {{-- バリデーションエラー表示 --}}
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- お問い合わせ内容 -->
                        <div class="mt-4">
                            <label for="message" class="block font-medium text-sm text-gray-700 dark:text-gray-300 sr-only">メッセージ</label>
                            <textarea id="message" name="message" rows="5" required placeholder="メッセージを入力してください"
                                      class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('message') }}</textarea>
                            {{-- バリデーションエラー表示 --}}
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>
                        
                        <!-- 利用規約同意 -->
                        <div class="mt-4">
                            <label for="agreement" class="inline-flex items-center">
                                <input id="agreement" type="checkbox" name="agreement" required 
                                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    利用規約に同意します。
                                    <a href="#" class="underline hover:text-gray-900 dark:hover:text-gray-100">
                                        プライバシーポリシーはこちら
                                    </a>
                                </span>
                            </label>
                            {{-- バリデーションエラー表示 --}}
                            <x-input-error :messages="$errors->get('agreement')" class="mt-2" />
                        </div>

                        <!-- 送信ボタン -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                確認
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>