@extends('layouts.app')

@section('title','تعديل المنشور')

@section('content')

<div class="container my-5" style="max-width: 600px;">

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <h4 class="fw-bold text-center mb-4">تعديل المنشور</h4>

            <form action="{{ route('posts.update',$post->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- المحتوى -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">المحتوى</label>
                    <textarea name="content"
                              rows="4"
                              class="form-control">{{ old('content',$post->content) }}</textarea>
                </div>

                <!-- الصورة الحالية -->
                @if($post->image)
                    <div class="mb-3 text-center">
                        <img src="{{ asset('storage/'.$post->image) }}"
                             class="img-fluid rounded"
                             style="max-height:200px;">
                    </div>
                @endif

                <!-- تغيير الصورة -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">تغيير الصورة</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('posts.index') }}" 
                       class="btn btn-secondary">
                        رجوع
                    </a>

                    <button class="btn btn-primary">
                        تحديث
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
