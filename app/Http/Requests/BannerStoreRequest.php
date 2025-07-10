<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class BannerStoreRequest extends FormRequest
{
    use CustomeErrorResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        // ✅ Cast booleans from string to actual boolean
        foreach (
            [
                'is_active',
            ] as $boolField
        ) {
            if ($this->has($boolField)) {
                $value = $this->input($boolField);
                $this->merge([
                    $boolField => filter_var($value, FILTER_VALIDATE_BOOLEAN),
                ]);
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "banner_page" => ['required', 'string', 'max:255'],
            "content" => ['required', 'string', 'max:255'],
            "banner_height_size" => ['required', 'numeric'],
            "banner_width_size" => ['required', 'numeric'],
            "is_active" => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'url' => 'The :attribute must be a valid URL.',
            'in' => 'The :attribute must be one of the following types: :values.',
            'array' => 'The :attribute must be a valid list.',
            'image' => 'The :attribute must be an image file.',
            'mimes' => 'The :attribute must be a file of type: :values.',
        ];
    }

    public function attributes(): array
    {
        return [
            'banner_page' => 'banner Page',
            'content' => 'banner contents',
            'banner_height_size' => 'banner height',
            'banner_width_size' => 'banner width',
            'is_active' => 'is banner active',
        ];
    }
}
