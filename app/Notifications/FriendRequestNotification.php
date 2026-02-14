<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequestNotification extends Notification
{
    use Queueable;

    protected $sender;

   
    public function __construct($sender)
    {
         $this->sender = $sender;
    }

   
    public function via(object $notifiable): array
    {
        return ['database'];
    }

        public function toDatabase($notifiable)
    {
        return [
            'sender_id'   => $this->sender->id,
            'sender_name' => $this->sender->name,
            'message'     => $this->sender->name . ' sent you a friend request',
        ];
    }
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
