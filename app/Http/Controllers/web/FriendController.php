<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\FriendService;
use Illuminate\Http\Request;
use App\Notifications\FriendRequestNotification;
class FriendController extends Controller
{
        public function __construct(private FriendService $service)
    {
    }

    public function send(User $user)
    {
        $this->service->send(Auth::user(), $user);
       $user->notify(new FriendRequestNotification(Auth::user()));
        

        return back()->with('success', 'تم إرسال الطلب');
    }

    public function accept(FriendRequest $request)
    {
        if ($request->receiver_id !== Auth::id()) {
          abort(403);
        }
        $this->service->accept($request);

        return back()->with('success', 'تم قبول الطلب');
    }

    public function reject(FriendRequest $request)
    {
        $this->service->reject($request);

        return back()->with('success', 'تم رفض الطلب');
    }

    public function search(Request $request)
{
    $query = $request->get('q');

    $users = User::where('id','!=',Auth::id())
        ->where('name','LIKE',"%$query%")
        ->limit(10)
        ->get();

    return view('posts.search', compact('users','query'));
}

public function friends()
{
    $friends = Auth::user()->allFriends()->get();

    return view('posts.friends', compact('friends'));
}

}
