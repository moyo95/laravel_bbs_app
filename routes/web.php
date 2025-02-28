<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//ログイン必須の新規投稿と保存のルート設定
Route::middleware(['auth'])->group(function (){
    Route::get('posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('posts', [PostController::class, 'store'])->name('post.store');
});

//未ログインでもアクセス可能な一覧と詳細ページ
Route::resource('posts', PostController::class)->only(['index', 'show']);

//編集・削除はログインが必要だが、権限はポリシーで制限
Route::resource('posts', PostController::class)->except(['create', 'store', 'index', 'show'])->middleware('auth');


Route::resource('posts',PostController::class);

//コメントを投稿するルーティング
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

//いいねを投稿するルーティング
Route::post('posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like')->middleware('auth');

//お問合せフォーム
// Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// Route::post('/contact/confirm', [CommentController::class, 'confirm'])->name('contact.confirm');
// Route::post('/contact/send', [CommentController::class, 'send'])->name('contact.send');
// Route::get('/contact/complete', [CommentController::class, 'complete'])->name('contact.complete');
//お問合せフォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm'); // 修正
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');


require __DIR__.'/auth.php';
