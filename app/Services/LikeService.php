<?php

namespace App\Services;
use App\Models\Post;
use App\Models\Like;
use App\Notifications\LikeNotification;

class LikeService
{
        public function toggle(Post $post, int $userId): void
    {
        $like = $post->likes()
            ->where('user_id', $userId)
            ->first();

        if ($like) {

            
            $like->delete();

        } else {

           
            $like = $post->likes()->create([
                'user_id' => $userId,
            ]);

            
            if ($post->user_id !== $userId) {

                $post->user->notify(
                    new LikeNotification($like)
                );

            }

        }
    }
}
