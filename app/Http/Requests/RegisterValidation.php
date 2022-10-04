<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'fullName' => 'required',
            'photo_file' => 'required|max:2048|file|image',
            'birthday' => 'required|date',
            'privacy' => 'required'
        ];
    }
}
