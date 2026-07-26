<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'content' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок обязателен для заполнения',
            'title.string' => 'Заголовок должен быть строкой',
            'title.max' => 'Заголовок не должен превышать 255 символов',
            'title.min' => 'Заголовок должен содержать минимум 3 символа',
            'category_id.required' => 'Выберите категорию',
            'category_id.integer' => 'Категория должна быть числом',
            'category_id.exists' => 'Выбранная категория не существует',
            'user_id.exists' => 'Нет такого пользователя',
            'user_id.required' => 'Укажите пользователя',
            'content.required' => 'Содержание поста обязательно',
            'content.string' => 'Содержание должно быть текстом',
            'content.min' => 'Содержание должно содержать минимум 10 символов',
        ];
    }
}
