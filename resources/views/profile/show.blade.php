@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
<div class="container my-5">
  <div class="card p-4 shadow-lg border-0" style="max-width: 600px; margin: auto;">
    
    <div class="text-center mb-4">
      @if(Auth::user()->profile_image)
          <img src="{{asset('storage/'.Auth::user()->profile_image)}}"
               alt="صورة المستخدم" 
               class="rounded-circle shadow" 
               width="120" height="120" 
               style="object-fit: cover;">
      @else
          <i class="bi bi-person-circle text-secondary" style="font-size: 100px;"></i>
      @endif
      <h3 class="mt-3">{{ Auth::user()->name }} :الاسم</h3>
      <p class="text-muted">{{ Auth::user()->email }} :البريد الكتروني</p>
      <p class="mt-3">{{ Auth::user()->bio }} :الوصف</p>
      <p class="mt-3">{{ Auth::user()->address }} :العنوان</p>
    </div>

    <hr>

    <div class="mt-3">
      <p class="fw-semibold">تاريخ الإنضمام:
        <span class="text-success">{{ Auth::user()->created_at->format('Y-m-d') }}</span>
      </p>
    </div>

    <div class="text-center mt-4 d-flex justify-content-center gap-2">
      <a href="{{route('profile.edit')}}" class="btn btn-warning px-4 fw-semibold">تعديل الملف الشخصي</a>
      <a href="{{ route('posts.index') }}" class="btn btn-primary px-4 fw-semibold">العودة للرئيسية</a>
    </div>
  </div>
</div>
<div class="container mt-5" style="max-width: 700px;">
    <h4 class="fw-bold mb-4">منشوراتي</h4>

    @forelse($posts as $post)

        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="text-muted small">
                        {{ $post->created_at->diffForHumans() }}
                    </div>

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
                </div>

                <p>{{ $post->content }}</p>

                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}"
                         class="img-fluid rounded mt-2">
                @endif

            </div>
        </div>

    @empty
        <div class="text-muted text-center">
            لم تقم بنشر أي منشورات بعد
        </div>
    @endforelse
</div>

@endsection