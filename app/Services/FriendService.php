<?php

namespace App\Services;
use App\Models\User;
use App\Models\FriendRequest;

class FriendService
{
        public function send(User $sender, User $receiver)
    {
        if ($sender->id === $receiver->id) {
            abort(400, 'لا يمكنك إرسال طلب لنفسك');
        }

        if ($this->alreadyFriends($sender, $receiver)) {
            abort(400, 'أنتم أصدقاء بالفعل');
        }

        if ($this->pendingExists($sender, $receiver)) {
            abort(400, 'هناك طلب صداقة بالفعل');
        }

        return FriendRequest::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'status' => 'pending'
        ]);
    }

    public function accept(FriendRequest $request)
    {
        $request->update(['status' => 'accepted']);
    }

    public function reject(FriendRequest $request)
    {
        $request->update(['status' => 'rejected']);
    }

    private function alreadyFriends(User $a, User $b): bool
    {
        return FriendRequest::where(function ($q) use ($a, $b) {
                $q->where('sender_id', $a->id)
                  ->where('receiver_id', $b->id);
            })
            ->orWhere(function ($q) use ($a, $b) {
                $q->where('sender_id', $b->id)
                  ->where('receiver_id', $a->id);
            })
            ->where('status', 'accepted')
            ->exists();
    }

    private function pendingExists(User $a, User $b): bool
    {
        return FriendRequest::where(function ($q) use ($a, $b) {
                $q->where('sender_id', $a->id)
                  ->where('receiver_id', $b->id);
            })
            ->orWhere(function ($q) use ($a, $b) {
                $q->where('sender_id', $b->id)
                  ->where('receiver_id', $a->id);
            })
            ->where('status', 'pending')
            ->exists();
    }
}
