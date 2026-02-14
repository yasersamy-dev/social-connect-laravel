<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\LikeService;

class LikeController extends Controller
{
    public function like(Post $post, Request $request)
{
    $userId = $request->user()->id;

    if ($post->likes()->where('user_id', $userId)->exists()) {
        return response()->json([
            'status' => false,
            'message' => 'Already liked'
        ], 400);
    }

    $post->likes()->create([
        'user_id' => $userId
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Post liked successfully'
    ]);
}

public function unlike(Post $post, Request $request)
{
    $userId = $request->user()->id;

    $like = $post->likes()->where('user_id', $userId)->first();

    if (!$like) {
        return response()->json([
            'status' => false,
            'message' => 'Like not found'
        ], 404);
    }

    $like->delete();

    return response()->json([
        'status' => true,
        'message' => 'Post unliked successfully'
    ]);
}

}
