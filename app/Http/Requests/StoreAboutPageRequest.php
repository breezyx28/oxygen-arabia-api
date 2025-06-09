<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreAboutPageRequest extends FormRequest
{
    use CustomeErrorResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "hero_title" => ["required", "string", "max:255"],
            "hero_subtitle" => ["required", "string", "max:255"],
            "section_1_img_1" => [
                "required",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048",
            ],
            "section_1_img_2" => [
                "required",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048"
            ],
            "section_1_img_3" => [
                "required",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048"
            ],
            "section_1_title" => ["required", "string", "max:255"],
            "section_1_description" => ["required", "string", "max:255"],
            "section_2_img" => [
                "required",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048"
            ],
            "section_2_part_1_title" => ["required", "string", "max:255"],
            "section_2_part_1_description" => ["required", "string"],
            "section_2_part_2_title" => ["required", "string", "max:255"],
            "section_2_part_2_description" => ["required", "string"],
        ];
    }
}
