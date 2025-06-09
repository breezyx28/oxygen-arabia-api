<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectPageDetailsRequest extends FormRequest
{
    use CustomeErrorResponse;
    public function authorize()
    {
        return true; // Adjust if necessary
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}
