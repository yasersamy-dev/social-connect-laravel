<?php

namespace App\Http\Controllers\web\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    
    public function __construct(private CommentService $service)
    {
        
    }
        public function store(CreateCommentRequest $request, Post $post)
    {
        $this->service->create(
            $post,
            Auth::id(),
            $request->validated()['content']
        );

        return back()->with('success', 'تم إضافة التعليق');
    }

    public function destroy(Comment $comment)
    {
        $this->service->delete($comment, Auth::id());

        return back()->with('success', 'تم حذف التعليق');
    }
}
