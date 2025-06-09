<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersMessagesRequest extends FormRequest
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
            "firstname" => ["required", "string", "max:191"],
            "lastname" => ["required", "string", "max:191"],
            "email" => ["required", "string", "max:191"],
            "message" => ["required", "string", "max:191"],
        ];
    }
}
