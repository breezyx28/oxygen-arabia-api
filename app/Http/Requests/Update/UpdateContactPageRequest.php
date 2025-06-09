<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactPageRequest extends FormRequest
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
            "hero_title" => ["nullable", "string", "max:255"],
            "hero_subtitle" => ["nullable", "string", "max:255"],
            "card_title" => ["nullable", "string", "max:255"],
            "card_subtitle" => ["nullable", "string", "max:255"],
            "form_firstname_label" => ["nullable", "string", "max:255"],
            "form_firstname_placeholder" => ["nullable", "string", "max:255"],
            "form_lastname_label" => ["nullable", "string", "max:255"],
            "form_lastname_placeholder" => ["nullable", "string", "max:255"],
            "form_email_label" => ["nullable", "string", "max:255"],
            "form_email_placeholder" => ["nullable", "string", "max:255"],
            "form_message_label" => ["nullable", "string", "max:255"],
            "form_message_placeholder" => ["nullable", "string", "max:255"],
            "form_button_text" => ["nullable", "string", "max:255"],
        ];
    }
}
