<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreHeroRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sm_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
        ];
    }
}
