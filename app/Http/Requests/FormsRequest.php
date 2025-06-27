<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class FormsRequest extends FormRequest
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
            'page_name' => ['required', 'string', 'max:255'],
            'form_header_title' => ['required', 'string', 'max:500'],
            'form_direction' => ['required', 'string', 'max:100'],
            'form_person_img' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'form_person_qoute' => ['required', 'string', 'max:255'],
            'form_person_name' => ['required', 'string', 'max:255'],
            'form_person_position' => ['required', 'string', 'max:255'],

            // First Name
            'input_first_name_label' => ['required', 'string', 'max:255'],
            'input_first_name_placeholder' => ['required', 'string', 'max:255'],

            // Last Name
            'input_last_name_label' => ['required', 'string', 'max:255'],
            'input_last_name_placeholder' => ['required', 'string', 'max:255'],

            // Email
            'input_email_label' => ['required', 'string', 'max:255'],
            'input_email_placeholder' => ['required', 'string', 'max:255'],

            // Phone
            'input_phone_label' => ['required', 'string', 'max:255'],
            'input_phone_placeholder' => ['required', 'string', 'max:255'],

            // Company
            'input_company_name_label' => ['required', 'string', 'max:255'],
            'input_company_name_placeholder' => ['required', 'string', 'max:255'],
            'input_company_size_label' => ['required', 'string', 'max:255'],
            'input_company_size_placeholder' => ['required', 'string', 'max:255'],

            // Most Interested Options
            'option_most_interested_label' => ['required', 'string', 'max:255'],
            'option_most_interested_options' => ['required', 'array'],
            'option_most_interested_options.*' => ['required', 'string', 'max:255'],

            // Button and Footer
            'form_btn_title' => ['required', 'string', 'max:255'],
            'form_footer' => ['required', 'string', 'max:255'],

            // Form active
            'is_active' => ['required', 'boolean'],
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
            // Basic
            'page_name' => 'Page Name',
            'form_header_title' => 'Form Header Title',
            'form_direction' => 'Form Direction',
            'form_person_img' => 'Form Person Image',
            'form_person_qoute' => 'Form Person Quote',
            'form_person_name' => 'Form Person Name',
            'form_person_position' => 'Form Person Position',

            // First Name
            'input_first_name_label' => 'First Name Label',
            'input_first_name_placeholder' => 'First Name Placeholder',

            // Last Name
            'input_last_name_label' => 'Last Name Label',
            'input_last_name_placeholder' => 'Last Name Placeholder',

            // Email
            'input_email_label' => 'Email Label',
            'input_email_placeholder' => 'Email Placeholder',

            // Phone
            'input_phone_label' => 'Phone Label',
            'input_phone_placeholder' => 'Phone Placeholder',

            // Company
            'input_company_name_label' => 'Company Name Label',
            'input_company_name_placeholder' => 'Company Name Placeholder',
            'input_company_size_label' => 'Company Size Label',
            'input_company_size_placeholder' => 'Company Size Placeholder',

            // Most Interested
            'option_most_interested_options' => 'Most Interested Options',
            'option_most_interested_options.*' => 'Most Interested Option',

            // Button & Footer
            'form_btn_title' => 'Form Button Title',
            'form_footer' => 'Form Footer',

            // Active
            'is_active' => 'Form Active Status',
        ];
    }
}
