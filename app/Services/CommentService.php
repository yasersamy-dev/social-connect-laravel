<?php

namespace App\Services;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\CommentNotification;

class CommentService
{
        public function create(Post $post, int $userId, string $content): Comment
    {
        $comment = $post->comments()->create([
            'user_id' => $userId,
            'content' => $content,
        ]);

        
        if ($post->user_id !== $userId) {

            $post->user->notify(
                new CommentNotification($comment)
            );

        }

        return $comment;
    }


    public function delete(Comment $comment, int $userId): void
    {
        if ($comment->user_id !== $userId) {
            abort(403);
        }

        $comment->delete();
    }
}
