<?php

namespace App\Http\Controllers\Web\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\PostsService;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct(private PostsService $postsService)
    {
        $this->postsService = $postsService;
    }

     public function index()
    {
        $posts = $this->postsService->getAllPosts();
        
    $suggestedUsers = User::where('id', '!=', Auth::id())
        ->whereDoesntHave('sentRequests', function ($q) {
            $q->where('receiver_id', Auth::id());
        })
        ->whereDoesntHave('receivedRequests', function ($q) {
            $q->where('sender_id', Auth::id());
        })
        ->limit(5)
        ->get();
    $pendingRequests = FriendRequest::with('sender')
        ->where('receiver_id', auth()->id())
        ->where('status', 'pending')
        ->latest()
        ->get();

        return view('home.index', compact('posts','suggestedUsers','pendingRequests'));
    }

    public function show(Post $post)
{
    $post->load(['user','comments.user','likes']);

    return view('posts.show', compact('post'));
}


    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {

        $this->postsService->createPost($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'تم نشر المنشور بنجاح');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $this->postsService->updatePost($post, $request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'تم تحديث المنشور بنجاح');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $this->postsService->deletePost($post);

        return redirect()->route('posts.index')
            ->with('success', 'تم حذف المنشور');
    }
}
