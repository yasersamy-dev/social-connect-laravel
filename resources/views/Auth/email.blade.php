@extends('layouts.auth')

@section('title','إعادة تعيين كلمة المرور')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card p-4 shadow">
            <h4 class="text-center mb-3">أدخل بريدك الإلكتروني</h4>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
                </div>

                <button class="btn btn-primary w-100">
                    إرسال رابط إعادة التعيين
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
