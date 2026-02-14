<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function ShowProfile(){
         $user = Auth::user();

         $posts = $user->posts()
                      ->latest()
                      ->get();
        return view('profile.show',compact('user','posts'));
    }
    public function edit(){
        return view('profile.edit');
    }
    public function update(UpdateProfileRequest $request){
        $user= Auth::user();

 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->address = $request->address;

        if ($request->hasFile('profile_image')) {

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->profile_image = $request->file('profile_image')
            ->store('profiles', 'public');
    }

        $user->save();

         return redirect()->route('ShowProfile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
