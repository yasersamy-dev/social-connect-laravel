@extends('layouts.app')

@section('title','الرئيسية')

@section('content')

<div class="container my-5">
    <div class="row">

        <!-- ===================== -->
        <!--        الفيد          -->
        <!-- ===================== -->
        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">أحدث المنشورات</h4>
                <a href="{{ route('posts.create') }}" class="btn btn-success">
                    + إضافة منشور
                </a>
            </div>

            @forelse($posts as $post)

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">

                    <!-- معلومات المستخدم -->
                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <div class="d-flex align-items-center gap-2">

                            @if($post->user->profile_image)
                                <img src="{{ asset('storage/'.$post->user->profile_image) }}"
                                     class="rounded-circle"
                                     width="45"
                                     height="45"
                                     style="object-fit:cover;">
                            @else
                                <i class="bi bi-person-circle fs-3 text-secondary"></i>
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

                    <!-- محتوى -->
                    <p class="mt-3">{{ $post->content }}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}"
                             class="img-fluid rounded mt-2">
                    @endif

                    <hr>

                    <!-- لايك + تعليق -->
                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <div class="d-flex align-items-center gap-2">

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

                        <a href="{{ route('posts.show',$post->id) }}"
                           class="btn btn-light btn-sm">
                            💬 عرض التعليقات ({{ $post->comments->count() }})
                        </a>

                    </div>

                    <!-- آخر 3 تعليقات -->
                    @foreach($post->comments->take(3) as $comment)
                        <div class="border rounded p-2 mb-2">

                            <div class="d-flex justify-content-between">
                                <strong>{{ $comment->user->name }}</strong>

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

                            <div class="text-muted small">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>

                            <p class="mt-1 mb-0">{{ $comment->content }}</p>

                        </div>
                    @endforeach

                    <!-- فورم إضافة تعليق -->
                    <form action="{{ route('comments.store',$post->id) }}" method="POST">
                        @csrf
                        <div class="input-group mt-2">
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

            @empty
                <div class="text-center text-muted">
                    لا توجد منشورات بعد
                </div>
            @endforelse

            {{ $posts->links() }}

        </div>
        <div class="col-md-4">

    <!-- ===================== -->
    <!--    طلبات الصداقة      -->
    <!-- ===================== -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <h5 class="fw-bold mb-3">طلبات الصداقة</h5>

            @forelse($pendingRequests as $request)

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div class="d-flex align-items-center gap-2">

                        @if($request->sender->profile_image)
                            <img src="{{ asset('storage/'.$request->sender->profile_image) }}"
                                 class="rounded-circle"
                                 width="40"
                                 height="40"
                                 style="object-fit:cover;">
                        @else
                            <i class="bi bi-person-circle fs-4 text-secondary"></i>
                        @endif

                        <span>{{ $request->sender->name }}</span>

                    </div>

                    <div class="d-flex gap-1">

                        <form action="{{ route('friends.accept',$request->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success">
                                قبول
                            </button>
                        </form>

                        <form action="{{ route('friends.reject',$request->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger">
                                رفض
                            </button>
                        </form>

                    </div>

                </div>

            @empty
                <div class="text-muted text-center">
                    لا توجد طلبات حالياً
                </div>
            @endforelse

        </div>
    </div>


    <!-- ===================== -->
    <!--   اقتراحات أصدقاء     -->
    <!-- ===================== -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="fw-bold mb-3">اقتراحات أصدقاء</h5>

            @forelse($suggestedUsers as $user)

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div class="d-flex align-items-center gap-2">

                        @if($user->profile_image)
                            <img src="{{ asset('storage/'.$user->profile_image) }}"
                                 class="rounded-circle"
                                 width="40"
                                 height="40"
                                 style="object-fit:cover;">
                        @else
                            <i class="bi bi-person-circle fs-4 text-secondary"></i>
                        @endif

                        <span>{{ $user->name }}</span>

                    </div>

                    <form action="{{ route('friends.send',$user->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-primary">
                            إضافة
                        </button>
                    </form>

                </div>

            @empty
                <div class="text-muted text-center">
                    لا توجد اقتراحات حالياً
                </div>
            @endforelse

        </div>
    </div>

</div>

    </div>
</div>

@endsection
