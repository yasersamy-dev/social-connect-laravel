<?php

namespace App\Http\Controllers\web\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
        public function __construct(private LikeService $service)
    {
    }

    public function toggle(Post $post)
    {
        $this->service->toggle($post, Auth::id());

        return back();
    }
}
