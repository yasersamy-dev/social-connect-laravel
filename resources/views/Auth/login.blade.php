@extends('layouts.auth')
@section('title') تسجيل دخول  @endsection
@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-11 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">تسجيل الدخول</h3>

                <form method="POST" action="{{route('login')}}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            دخول
                        </button>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{route('ShowRegisterForm')}}">إنشاء حساب</a>
                        <a href="{{ route('password.request') }}">إعادة تعيين كلمة المرور</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
