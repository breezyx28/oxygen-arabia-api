<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:services,name', // e.g., AC Services, Annual Maintenance, MEP Solution
            'description' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'page_subtitle' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The service name is required.',
            'name.max' => 'The service name cannot exceed 255 characters.',
            'name.unique' => 'The service is already existed.',

            'dscription.required' => 'The service dscription is required.',
            'description.max' => 'The service description cannot exceed 255 characters.',

            'page_title.required' => 'The service page title is required.',
            'page_title.max' => 'The service page title cannot exceed 255 characters.',

            'page_subtitle.required' => 'The service page subtitle is required.',
            'page_subtitle.max' => 'The service page subtitle cannot exceed 255 characters.',
        ];
    }
}
