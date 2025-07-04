<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Post;
// use Illuminate\Support\Facades\Auth;
// use App\Notifications\LikeNotification;



// class LikeController extends Controller
// {
//     public function toggleLike(Post $post)
//     {
//         // ログインしていなければ、ログインページへリダイレクト
//         if (!auth()->check()) {
//             return redirect()->route('login');
//         }
        
//         // すでにいいねしているか確認
//         $user = Auth::user();
//         $like = $post->likes()->where('user_id', $user->id);

//         if ($like->exists()){
//             // いいねを解除
//             $like->delete();
//         } else {
//             // いいねを追加
//             $post->likes()->create(['user_id' => $user->id]);

//             // 投稿者に通知を送信
//             // $post->user->notify(new LikeNotification($post));
//         }

        

//         return response()->json([
//             'liked' => $post->likes()->where('user_id', $user->id)->exists(),
//             'like_count' => $post->likes()->count()
//         ]);
//     }
// }

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Logファサードを追加

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $user = Auth::user();
        $like = $post->likes()->where('user_id', $user->id)->first();
        $isLiked = false;

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $isLiked = true;
        }
        
        $likeCount = $post->fresh()->likes()->count();

        return response()->json([
            'liked'      => $isLiked,
            'like_count' => $likeCount,
        ]);
    }
}