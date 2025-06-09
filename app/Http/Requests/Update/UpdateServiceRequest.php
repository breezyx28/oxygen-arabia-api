<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string', // e.g., AC Services, Annual Maintenance, MEP Solution
            'description' => 'nullable|string|max:255',
            'page_title' => 'nullable|string|max:255',
            'page_subtitle' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'The service name cannot exceed 255 characters.',

            'description.max' => 'The service description cannot exceed 255 characters.',

            'page_title.max' => 'The service page title cannot exceed 255 characters.',

            'page_subtitle.max' => 'The service page subtitle cannot exceed 255 characters.',
        ];
    }
}
