<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Services\CommentService;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    
    public function __construct(private CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    
    public function store(CreateCommentRequest $request, Post $post)
    {
        
        $userId = $request->user()->id;

        $comment = $this->commentService->create($post, $userId, $request->content);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }

    
    public function destroy(Comment $comment, Request $request)
    {
        $userId = $request->user()->id;

        $this->commentService->delete($comment, $userId);

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
    
}
