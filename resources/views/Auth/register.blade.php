@extends('layouts.auth')
@section('title') انشاء حساب  @endsection
@section('content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-11 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">إنشاء حساب</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <!-- Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-success">
                            تسجيل
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}">لديك حساب بالفعل؟ تسجيل الدخول</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


@endsection