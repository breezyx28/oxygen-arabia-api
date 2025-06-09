<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            "address" => ["required", "string", "max:191"],
            "phone" => ["required", "string", "max:191", "regex:/^\+?[0-9]{10,15}$/"],
            "email" => ["required", "string", "max:191"],
        ];
    }
}
