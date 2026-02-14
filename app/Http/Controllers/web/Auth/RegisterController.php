<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function ShowRegisterForm(){
        return view('Auth.register');
    }

    public function register(RegisterRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
        ]);

         return redirect()->route('posts.index')->with('success', 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن');
    }
}
