<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectPageDetailsRequest extends FormRequest
{
    use CustomeErrorResponse;
    public function authorize()
    {
        return true; // Adjust if necessary
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
