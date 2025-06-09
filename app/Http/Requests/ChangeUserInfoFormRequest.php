<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangeUserInfoFormRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize()
    {
        return true; // Adjust authorization as needed
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $this->user()->id,
            'password' => [
                'nullable',
                'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email address is already taken.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
