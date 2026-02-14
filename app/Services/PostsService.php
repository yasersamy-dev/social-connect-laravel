<?php

namespace App\Services;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsService
{
    public function getAllPosts()
    {
        return Post::with(['user', 'likes', 'comments.user'])
            ->latest()
            ->paginate(10);
    }

    public function createPost(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']
                ->store('posts', 'public');
        }

        $data['user_id'] = Auth::id();

        return Post::create($data);
    }

    public function updatePost(Post $post, array $data)
    {
        if (isset($data['image'])) {

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $data['image']
                ->store('posts', 'public');
        }

        $post->update($data);

        return $post;
    }

    public function deletePost(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        return $post->delete();
    }
}
