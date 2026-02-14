@extends('layouts.auth')

@section('title','تغيير كلمة المرور')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card p-4 shadow">
            <h4 class="text-center mb-3">تغيير كلمة المرور</h4>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="كلمة المرور الجديدة" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور" required>
                </div>

                <button class="btn btn-success w-100">
                    تحديث كلمة المرور
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
