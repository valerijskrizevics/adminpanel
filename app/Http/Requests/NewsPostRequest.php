<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use HTMLPurifier;
use HTMLPurifier_Config;

class NewsPostRequest extends FormRequest
{
    protected array $sanitizedData = [];
    protected array $xssDetectedFields = [];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->sanitizedData = []; // Store sanitized values separately

        foreach (['title', 'short_description', 'text'] as $field) {
            $original = $this->input($field);

            // Don't modify original input before validation
            $sanitized = $this->sanitizeText($original);

            // Store sanitized values but do NOT merge yet
            $this->sanitizedData[$field] = $sanitized;

            // Detect XSS only if the original input was NOT empty
            if (!empty($original) && $original !== $sanitized) {
                $this->xssDetectedFields[$field] = true;
            }
        }

        $this->merge([
            'text' => $this->sanitizedData['text'] ?? '',
        ]);
    }

    /**
     * Sanitize text input to prevent XSS.
     *
     * @param string|null $value
     * @return string
     */
    protected function sanitizeText(?string $value): string
    {
        if (is_null($value)) {
            return '';
        }

        // Initialize HTMLPurifier
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($value);
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
        ];
    }

    /**
     * After validation hook: Detect XSS and add errors manually.
     */
    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->xssDetectedFields as $field => $flag) {
                $validator->errors()->add($field, "Potential XSS attack detected. Please remove any unsafe content.");
            }
        });
    }

    /**
     * Retrieve sanitized data separately.
     */
    public function getSanitizedData(): array
    {
        return $this->sanitizedData;
    }
}
