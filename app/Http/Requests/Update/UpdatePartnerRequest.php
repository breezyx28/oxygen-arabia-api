<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'logo' => 'exclude_if:logo,null|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, or svg.',
        ];
    }
}
