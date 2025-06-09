<?php

namespace App\Http\Requests\Update;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAboutPageRequest extends FormRequest
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
            "hero_title" => ["nullable", "string", "max:255"],
            "hero_subtitle" => ["nullable", "string", "max:255"],
            "section_1_img_1" => [
                "exclude_if:section_1_img_1,null",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048",
            ],
            "section_1_img_2" => [
                "exclude_if:section_1_img_2,null",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048"
            ],
            "section_1_img_3" => [
                "exclude_if:section_1_img_3,null",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048"
            ],
            "section_1_title" => ["nullable", "string", "max:255"],
            "section_1_description" => ["nullable", "string", "max:255"],
            "section_2_img" => [
                "exclude_if:section_2_img,null",
                "image",
                "mimes:jpeg,png,jpg,gif,svg",
                "max:2048"
            ],
            "section_2_part_1_title" => ["nullable", "string", "max:255"],
            "section_2_part_1_description" => ["nullable", "string"],
            "section_2_part_2_title" => ["nullable", "string", "max:255"],
            "section_2_part_2_description" => ["nullable", "string"],
        ];
    }
}
