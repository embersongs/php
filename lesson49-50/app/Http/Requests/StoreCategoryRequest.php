<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'min:3', 'unique:categories,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Заголовок обязателен для заполнения',
            'name.string' => 'Заголовок должен быть строкой',
            'name.max' => 'Заголовок не должен превышать 255 символов',
            'name.min' => 'Заголовок должен содержать минимум 3 символа',
            'name.unique' => 'Категория должна быть уникальной',

        ];
    }
}
