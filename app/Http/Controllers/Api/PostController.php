<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostsService;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


class PostController extends Controller
{
    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
    }
   
    public function index()
    {
         $posts = $this->postsService->getAllPosts();

        return response()->json([
            'status' => true,
            'message' => 'Posts fetched successfully',
            'data' => $posts
        ]);
    }

   
    public function store(Request $request)
    {
         $validated = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image');
        }

        $post = $this->postsService->createPost($validated);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }

   
    public function show(Post $post)
    {
        $post->load(['user', 'likes', 'comments.user']);

        return response()->json([
            'status' => true,
            'message' => 'Post fetched successfully',
            'data' => $post
        ]);
    }

   
    public function update(Request $request,  Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image');
        }

        $post = $this->postsService->updatePost($post, $validated);

        return response()->json([
            'status' => true,
            'message' => 'Post updated successfully',
            'data' => $post
        ]);
    }

   
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $this->postsService->deletePost($post);

        return response()->json([
            'status' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
}
