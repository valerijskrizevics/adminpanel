<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users for now
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'text' => $this->text ?? '', // Convert null to empty string
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'short_description' => 'required|max:255',
            'text' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required.',
            'title.max' => 'The title should not exceed 100 characters.',
            
            'short_description.required' => 'A short description is required.',
            'short_description.max' => 'The short description should not exceed 255 characters.',

            'user_id.required' => 'Please select an author for this post.',
            'user_id.exists' => 'The selected author does not exist in the database.',
        ];
    }
}
