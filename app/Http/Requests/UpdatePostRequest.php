<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:2|max:100|' . Rule::unique('posts')->ignore($this->post),
            'slug' => 'required|min:2|max:100|' . Rule::unique('posts')->ignore($this->post),
            'body' => 'required|min:5',
        ];
    }
}