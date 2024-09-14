<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories', 'name')
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'name.max' => 'The category name can not be greater than 255 characters.',
            'name.unique' => 'The category name has already been taken.',
        ];
    }
}
