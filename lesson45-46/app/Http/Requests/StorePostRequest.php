<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'content' => ['required', 'string', 'max:65000', 'min:3'],
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
            'content.required' => 'Содержание поста обязательно',
            'content.string' => 'Содержание должно быть текстом',
            'content.min' => 'Содержание должно содержать минимум 10 символов',
        ];
    }
}
