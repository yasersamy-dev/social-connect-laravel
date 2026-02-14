<?php

namespace App\Notifications;

use App\Models\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

    protected $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'like_id' => $this->like->id,
            'post_id' => $this->like->post_id,
            'user_id' => $this->like->user_id,
            'message' => $this->like->user->name . ' liked your post',
        ];
    }
}

