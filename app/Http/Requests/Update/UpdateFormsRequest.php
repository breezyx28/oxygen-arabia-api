<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\FormsRequest;
use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFormsRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        // ✅ Cast booleans from string to actual boolean
        foreach (['is_active'] as $boolField) {
            if ($this->has($boolField)) {
                $value = $this->input($boolField);
                $this->merge([
                    $boolField => filter_var($value, FILTER_VALIDATE_BOOLEAN),
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            // Basic fields
            'page_name' => ['sometimes', 'string', 'max:255'],
            'form_header_title' => ['sometimes', 'string', 'max:500'],
            'form_direction' => ['sometimes', 'string', 'max:100'],
            'form_person_img' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'form_person_qoute' => ['sometimes', 'string', 'max:255'],
            'form_person_name' => ['sometimes', 'string', 'max:255'],
            'form_person_position' => ['sometimes', 'string', 'max:255'],

            // First Name
            'input_first_name_label' => ['sometimes', 'string', 'max:255'],
            'input_first_name_placeholder' => ['sometimes', 'string', 'max:255'],

            // Last Name
            'input_last_name_label' => ['sometimes', 'string', 'max:255'],
            'input_last_name_placeholder' => ['sometimes', 'string', 'max:255'],

            // Email
            'input_email_label' => ['sometimes', 'string', 'max:255'],
            'input_email_placeholder' => ['sometimes', 'string', 'max:255'],

            // Phone
            'input_phone_label' => ['sometimes', 'string', 'max:255'],
            'input_phone_placeholder' => ['sometimes', 'string', 'max:255'],

            // Company
            'input_company_name_label' => ['sometimes', 'string', 'max:255'],
            'input_company_name_placeholder' => ['sometimes', 'string', 'max:255'],
            'input_company_size_label' => ['sometimes', 'string', 'max:255'],
            'input_company_size_placeholder' => ['sometimes', 'string', 'max:255'],

            // Most Interested Options
            'option_most_interested_label' => ['required', 'string', 'max:255'],
            'option_most_interested_options' => ['sometimes', 'array'],
            'option_most_interested_options.*' => ['sometimes', 'string', 'max:255'],

            // Button and Footer
            'form_btn_title' => ['sometimes', 'string', 'max:255'],
            'form_footer' => ['sometimes', 'string', 'max:255'],

            // Form active
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return (new FormsRequest())->messages();
    }

    public function attributes(): array
    {
        return (new FormsRequest())->attributes();
    }
}
