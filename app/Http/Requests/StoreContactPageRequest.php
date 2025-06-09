<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactPageRequest extends FormRequest
{
    use CustomeErrorResponse;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "hero_title" => ["required", "string", "max:255"],
            "hero_subtitle" => ["required", "string", "max:255"],
            "card_title" => ["required", "string", "max:255"],
            "card_subtitle" => ["required", "string", "max:255"],
            "form_firstname_label" => ["required", "string", "max:255"],
            "form_firstname_placeholder" => ["required", "string", "max:255"],
            "form_lastname_label" => ["required", "string", "max:255"],
            "form_lastname_placeholder" => ["required", "string", "max:255"],
            "form_email_label" => ["required", "string", "max:255"],
            "form_email_placeholder" => ["required", "string", "max:255"],
            "form_message_label" => ["required", "string", "max:255"],
            "form_message_placeholder" => ["required", "string", "max:255"],
            "form_button_text" => ["required", "string", "max:255"],
        ];
    }
}
