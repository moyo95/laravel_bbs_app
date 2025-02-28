<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LikeNotification;



class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        // ログインしていなければ、ログインページへリダイレクト
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // すでにいいねしているか確認
        $user = Auth::user();
        $like = $post->likes()->where('user_id', $user->id);

        if ($like->exists()){
            // いいねを解除
            $like->delete();
        } else {
            // いいねを追加
            $post->likes()->create(['user_id' => $user->id]);

            // 投稿者に通知を送信
            $post->user->notify(new LikeNotification($post));
        }

        

        return response()->json([
            'liked' => $post->likes()->where('user_id', $user->id)->exists(),
            'like_count' => $post->likes()->count()
        ]);
    }
}

    
