<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;

Route::get('/test-page', function () { return 'テストページに到達しました！'; });
// "laravel" というプレフィックス（接頭辞）を全てのルートに適用する箱を開始
// Route::prefix('laravel')->group(function () {
// Route::prefix(env('ROUTE_PREFIX', ''))->group(function () {
Route::prefix('')->group(function () { // ← テスト用にこう書き換える

    // ▼▼▼ ここから下が修正・整理されたルートです ▼▼▼

    // トップページ（未ログインでもアクセス可能）
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

    // 投稿の一覧と詳細ページ（未ログインでもアクセス可能）
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // お問合せフォーム（未ログインでもアクセス可能）
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
    Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');


    // === ログイン済み、かつ、メール認証済みのユーザーのみがアクセス可能なルート ===
    Route::middleware(['auth', 'verified'])->group(function () {

        // ダッシュボード
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        // プロフィール関連
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // 投稿関連（新規作成、保存、編集、更新、削除）
        Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

        // コメント投稿
        Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

        // いいね機能
        Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');
        
    }); // --- ここまでが認証・認証済みエリア ---


    // ログイン、登録、パスワードリセットなどの認証関連ルートを読み込む
    require __DIR__.'/auth.php';

}); // ▲▲▲ ここで "laravel" プレフィックスの箱を閉じる ▲▲▲