<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\BannerStoreRequest;
use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
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
            "banner_page" => ['sometimes', 'string', 'max:255'],
            "content" => ['sometimes', 'string', 'max:255'],
            "banner_height_size" => ['sometimes', 'numeric'],
            "banner_width_size" => ['sometimes', 'numeric'],
            "is_active" => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return (new BannerStoreRequest)->messages();
    }

    public function attributes(): array
    {
        return (new BannerStoreRequest)->attributes();
    }
}
