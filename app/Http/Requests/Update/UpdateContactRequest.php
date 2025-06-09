<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            "address" => ["nullable", "string", "max:191"],
            "phone" => ["nullable", "string", "max:191", "regex:/^\+?[0-9]{10,15}$/"],
            "email" => ["nullable", "email:rfc,dns", "max:191"], // Stricter email validation
        ];
    }
}
