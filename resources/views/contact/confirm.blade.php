<x-app-layout>
    {{-- ページヘッダー部分 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('お問い合わせ内容の確認') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">
                    
                    <p class="mb-6 text-center">以下の内容で送信します。よろしいですか？</p>

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        {{-- 送信データをhiddenフィールドで保持 --}}
                        <input type="hidden" name="name" value="{{ $contactData['name'] }}">
                        <input type="hidden" name="email" value="{{ $contactData['email'] }}">
                        <input type="hidden" name="message" value="{{ $contactData['message'] }}">

                        <div class="space-y-6">
                            <!-- お名前 -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    お名前
                                </label>
                                <div class="mt-1 p-3 w-full bg-gray-100 dark:bg-gray-700 rounded-md">
                                    {{ $contactData['name'] }}
                                </div>
                            </div>

                            <!-- メールアドレス -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    メールアドレス
                                </label>
                                <div class="mt-1 p-3 w-full bg-gray-100 dark:bg-gray-700 rounded-md">
                                    {{ $contactData['email'] }}
                                </div>
                            </div>

                            <!-- メッセージ -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    メッセージ
                                </label>
                                {{-- whitespace-pre-wrapで改行を反映させる --}}
                                <div class="mt-1 p-3 w-full bg-gray-100 dark:bg-gray-700 rounded-md whitespace-pre-wrap">
                                    {{ $contactData['message'] }}
                                </div>
                            </div>
                        </div>

                        <!-- ボタン -->
                        <div class="flex items-center justify-center mt-8 space-x-4">
                            {{-- 修正ボタン --}}
                            <button type="button" onclick="history.back()" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                修正する
                            </button>

                            {{-- 送信ボタン --}}
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                送信する
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>