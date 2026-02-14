<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FriendRequest;
use App\Services\FriendService;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function __construct(private FriendService $service)
    {
    }

    public function send(User $user, Request $request)
    {
        $this->service->send($request->user(), $user);

        return response()->json([
            'status' => true,
            'message' => 'Friend request sent'
        ]);
    }

    public function accept(FriendRequest $requestModel, Request $request)
    {
        if ($requestModel->receiver_id !== $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $this->service->accept($requestModel);

        return response()->json([
            'status' => true,
            'message' => 'Friend request accepted'
        ]);
    }

    public function reject(FriendRequest $requestModel)
    {
        $this->service->reject($requestModel);

        return response()->json([
            'status' => true,
            'message' => 'Friend request rejected'
        ]);
    }

    public function index(Request $request)
    {
        $friends = $request->user()->allFriends()->get();

        return response()->json([
            'status' => true,
            'data' => $friends
        ]);
    }
}
