<?php

namespace App\Http\Requests\User\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateValidation extends FormRequest
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
            'name' => 'required',
            'full_description' => 'required',
            'short_description' => 'required|max:50',
            'tag' => 'required',
            'photo_file' => 'required|max:2048|file|image',
        ];
    }
}
