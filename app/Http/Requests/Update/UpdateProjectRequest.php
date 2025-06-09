<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    use CustomeErrorResponse;
    public function authorize()
    {
        return true; // Adjust if necessary
    }

    public function rules()
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',

            'description' => 'nullable|string',
            'card_description' => 'nullable|string',

            'page_title' => 'nullable|string|max:255',
            'page_subtitle' => 'nullable|string|max:255',
        ];
    }
}
