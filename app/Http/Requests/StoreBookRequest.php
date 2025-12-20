<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ISBN'=>'required|string|max:13|unique:books',
            'title'=>'required|string|max:50|unique:books',
            'price'=>'required|numeric|min:0',
            'mortgage'=>'required|numeric|min:0',
            'authorship_date'=>'nullable|date',
            'category_id'=>'required|exists:categories,id',
            'cover'=>'required|image|max:2048'
        ];
    }
}
