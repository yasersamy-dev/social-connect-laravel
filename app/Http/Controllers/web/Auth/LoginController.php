<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function ShowLoginForm(){

    return view('Auth.login');
    }

    public function login(LoginRequest $request){

     $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('posts.index');
    }

    return back()->withErrors([
        'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
    ]);
    }
}
