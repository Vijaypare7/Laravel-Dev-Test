<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product')->id;

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('products', 'name')->ignore($productId)
            ],
            'description' => [
                'required',
                'max:255'
            ],
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.unique' => 'The product name has already been taken.',
            'description.required' => 'The description is required.',
            'description.max' => 'The product description can not be greater than 255 characters.',
            'price.required' => 'The price is required.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category does not exist.',
        ];
    }
}
