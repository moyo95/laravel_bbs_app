<?php
//web.php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

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
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
});

//未ログインでもアクセス可能な一覧と詳細ページ
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

//編集・削除はログインが必要だが、権限はポリシーで制限
Route::middleware(['auth'])->group(function () {
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

//コメントを投稿するルーティング
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

//いいねを投稿するルーティング
// Route::post('posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like')->middleware('auth');
Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like')->middleware('auth');


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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
