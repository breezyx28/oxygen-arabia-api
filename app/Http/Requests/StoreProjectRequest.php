<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    use CustomeErrorResponse;
    public function authorize()
    {
        return true; // Adjust if necessary
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',

            'description' => 'required|string',
            'card_description' => 'required|string',
        ];
    }
}
