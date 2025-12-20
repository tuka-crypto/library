<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'ISBN'=>'required|string|max:13|unique:books,ISBN,'.$this->route('book')->ISBN,
            'title'=>'required|string|max:50|unique:books',
            'price'=>'numeric|min:0',
            'mortgage'=>'numeric|min:0',
            'authorship_date'=>'nullable|date',
            'category_id'=>'nullable|exists:categories,id',
            'cover'=>'nullable|image|max:2048'
        ];
    }
}
