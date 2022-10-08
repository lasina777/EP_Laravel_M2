<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class NewUserValidation extends FormRequest
{
    /**
     * Определяет, авторизирован ли пользователь, для выполнения запроса
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Правила проверки, применимые к запросу
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullName' => 'required',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|unique:users',
            'birthday' => 'required|date',
            'photo_file' => 'required|max:2048|file|image',
            'role_id' => 'required'
        ];
    }
}
