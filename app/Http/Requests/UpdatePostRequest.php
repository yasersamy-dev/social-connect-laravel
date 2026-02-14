<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:1000',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
