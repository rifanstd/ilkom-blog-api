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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'author_id' => 'required',
            'title' => 'required|min:2|max:100|unique:posts,title',
            'slug' => 'required|min:2|max:100|unique:posts,slug',
            'body' => 'required|min:5',
        ];
    }
}