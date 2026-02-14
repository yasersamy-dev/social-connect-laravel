@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">

            <h4 class="text-center mb-4 fw-bold">إضافة منشور جديد</h4>

            <form action="{{ route('posts.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <!-- Content -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">ماذا يدور في ذهنك؟</label>
                    <textarea name="content"
                              rows="4"
                              class="form-control"
                              placeholder="اكتب منشورك هنا...">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">إضافة صورة </label>
                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/*">
                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('posts.index') }}" 
                       class="btn btn-secondary px-4">
                        رجوع
                    </a>

                    <button type="submit" 
                            class="btn btn-primary px-4 fw-semibold">
                        نشر
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
