@extends('layouts.app')

@section('title','تفاصيل المنشور')

@section('content')

<div class="container my-5" style="max-width: 700px;">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- معلومات المستخدم -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <div class="d-flex align-items-center gap-2">

                    @if($post->user->profile_image)
                        <img src="{{ asset('storage/'.$post->user->profile_image) }}"
                             class="rounded-circle"
                             width="50"
                             height="50"
                             style="object-fit:cover;">
                    @else
                        <i class="bi bi-person-circle fs-2 text-secondary"></i>
                    @endif

                    <div>
                        <strong>{{ $post->user->name }}</strong>
                        <div class="text-muted small">
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>

                </div>

                @if(Auth::id() === $post->user_id)
                    <div class="d-flex gap-2">
                        <a href="{{ route('posts.edit',$post->id) }}"
                           class="btn btn-sm btn-warning">
                            تعديل
                        </a>

                        <form action="{{ route('posts.destroy',$post->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                حذف
                            </button>
                        </form>
                    </div>
                @endif

            </div>

            <!-- المحتوى -->
            <p class="mt-3 fs-5">{{ $post->content }}</p>

            @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}"
                     class="img-fluid rounded mt-2">
            @endif

            <hr>

            <!-- عدد اللايكات -->
            <div class="d-flex align-items-center gap-2 mb-3">

             <form action="{{ route('posts.like',$post->id) }}" method="POST">
                @csrf
                <button class="btn btn-sm 
                    {{ $post->likes->where('user_id',Auth::id())->count() ? 'btn-primary' : 'btn-outline-primary' }}">
                    👍 إعجاب
                </button>
            </form>

             <span class="text-muted">
                 {{ $post->likes->count() }} إعجاب
             </span>

       </div>

            <hr>

            <!-- التعليقات -->
            <h5 class="fw-bold mb-3">التعليقات ({{ $post->comments->count() }})</h5>

            @forelse($post->comments as $comment)

                <div class="border rounded p-3 mb-3">

                    <div class="d-flex justify-content-between">

                        <div class="d-flex align-items-center gap-2">

                            @if($comment->user->profile_image)
                                <img src="{{ asset('storage/'.$comment->user->profile_image) }}"
                                     class="rounded-circle"
                                     width="35"
                                     height="35"
                                     style="object-fit:cover;">
                            @else
                                <i class="bi bi-person-circle text-secondary"></i>
                            @endif

                            <strong>{{ $comment->user->name }}</strong>

                        </div>

                        @if(Auth::id() === $comment->user_id)
                            <form action="{{ route('comments.destroy',$comment->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    حذف
                                </button>
                            </form>
                        @endif

                    </div>

                    <div class="text-muted small mt-1">
                        {{ $comment->created_at->diffForHumans() }}
                    </div>

                    <p class="mt-2 mb-0">{{ $comment->content }}</p>

                </div>

            @empty
                <div class="text-muted text-center">
                    لا توجد تعليقات بعد
                </div>
            @endforelse

            <!-- فورم إضافة تعليق -->
            <form action="{{ route('comments.store',$post->id) }}" method="POST">
                @csrf
                <div class="input-group mt-3">
                    <input type="text"
                           name="content"
                           class="form-control"
                           placeholder="اكتب تعليق..."
                           required>
                    <button class="btn btn-primary">
                        نشر
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>

@endsection
