<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubserviceRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'service_id' => 'nullable|exists:services,id', // Ensures subservice is linked to a valid service
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'card_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'service_id.exists' => 'The specified service does not exist.',
            'title.max' => 'The subservice title cannot exceed 255 characters.',

            'subtitle.max' => 'The subservice subtitle cannot exceed 255 characters.',

            'description.max' => 'The subservice description cannot exceed 255 characters.',

            'card_description.max' => 'The subservice card_description cannot exceed 255 characters.',

            'image.image' => 'The subservice image must be a valid image file.',

            'card_image.image' => 'The subservice image must be a valid image file.',
        ];
    }
}
