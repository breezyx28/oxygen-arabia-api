<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\MainRequest;
use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMainRequest extends FormRequest
{
    use CustomeErrorResponse;

    public function authorize(): bool
    {
        return true;
    }

    // public function prepareForValidation(): void
    // {
    //     foreach (
    //         [
    //             'hero_card_1',
    //             'hero_card_2',
    //             'hero_slider_imgs',
    //             'section_2_icons',
    //             'section_3_card_1_features',
    //             'section_3_card_2_features',
    //             'section_3_card_3_features',
    //             'section_5_card_card',
    //             'section_6_slider',
    //         ] as $jsonField
    //     ) {
    //         if ($this->has($jsonField)) {
    //             $this->merge([
    //                 $jsonField => json_decode($this->input($jsonField), true),
    //             ]);
    //         }
    //     }
    // }

    public function rules(): array
    {
        return [
            // Images – make them optional
            'hero_cover' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'section_3_card_1_icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'section_3_card_2_icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'section_3_card_3_icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'section_4_cover' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'section_5_card_img' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

            // Strings – optional, so we use sometimes
            'hero_title' => ['sometimes', 'string', 'max:255'],
            'hero_subtitle' => ['sometimes', 'string', 'max:500'],
            'hero_cta_title' => ['sometimes', 'string', 'max:100'],
            'hero_cta_link' => ['sometimes', 'string', 'max:255', 'url'],
            'hero_slider_title' => ['sometimes', 'string', 'max:255'],

            'section_1_title' => ['sometimes', 'string', 'max:255'],
            'section_1_subtitle' => ['sometimes', 'string', 'max:500'],
            'section_1_card_1_title' => ['sometimes', 'string', 'max:255'],
            'section_1_card_1_subtitle' => ['sometimes', 'string', 'max:500'],
            'section_1_card_1_cta' => ['sometimes', 'string', 'max:255', 'url'],
            'section_1_card_2_title' => ['sometimes', 'string', 'max:255'],
            'section_1_card_2_subtitle' => ['sometimes', 'string', 'max:500'],
            'section_1_card_2_cta' => ['sometimes', 'string', 'max:255', 'url'],
            'section_1_card_3_title' => ['sometimes', 'string', 'max:255'],
            'section_1_card_3_subtitle' => ['sometimes', 'string', 'max:500'],
            'section_1_card_3_cta' => ['sometimes', 'string', 'max:255', 'url'],

            'section_2_title' => ['sometimes', 'string', 'max:255'],
            'section_2_subtitle' => ['sometimes', 'string', 'max:500'],

            'section_3_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_1_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_1_cta' => ['sometimes', 'string', 'max:255', 'url'],
            'section_3_card_2_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_2_cta' => ['sometimes', 'string', 'max:255', 'url'],
            'section_3_card_3_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_3_cta' => ['sometimes', 'string', 'max:255', 'url'],

            'section_4_title' => ['sometimes', 'string', 'max:255'],
            'section_4_cta_title' => ['sometimes', 'string', 'max:100'],
            'section_4_cta_link' => ['sometimes', 'string', 'max:255', 'url'],

            'section_5_title' => ['sometimes', 'string', 'max:255'],

            'section_6_title' => ['sometimes', 'string', 'max:255'],

            // JSON Arrays
            'hero_card_1' => ['sometimes', 'nullable', 'array'],
            'hero_card_1.*.title' => ['sometimes', 'string'],
            'hero_card_1.*.subtitle' => ['sometimes', 'string'],

            'hero_card_2' => ['sometimes', 'array'],
            'hero_card_2.*.title' => ['sometimes', 'string'],
            'hero_card_2.*.subtitle' => ['sometimes', 'string'],

            'hero_slider_imgs' => ['sometimes', 'nullable', 'array'],
            'hero_slider_imgs.*' => ['sometimes', 'string'],

            'section_2_icons' => ['sometimes', 'nullable', 'array'],
            'section_2_icons.*' => ['sometimes', 'string'],

            'section_3_card_1_features' => ['sometimes', 'array'],
            'section_3_card_1_features.*' => ['sometimes', 'string'],

            'section_3_card_2_features' => ['sometimes', 'array'],
            'section_3_card_2_features.*' => ['sometimes', 'string'],

            'section_3_card_3_features' => ['sometimes', 'array'],
            'section_3_card_3_features.*' => ['sometimes', 'string'],

            'section_5_card_card' => ['sometimes', 'array'],
            'section_5_card_card.*.title' => ['sometimes', 'string'],
            'section_5_card_card.*.subtitle' => ['sometimes', 'string'],

            'section_6_slider' => ['sometimes', 'array'],
            'section_6_slider.*.type' => ['sometimes', 'in:img,text'],
            'section_6_slider.*.icon' => ['nullable'],
            // 'section_6_slider.*.icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'section_6_slider.*.text_1_title' => ['nullable', 'string'],
            'section_6_slider.*.text_1_subtitle' => ['nullable', 'string'],
            'section_6_slider.*.text_2_title' => ['nullable', 'string'],
            'section_6_slider.*.text_2_subtitle' => ['nullable', 'string'],
            'section_6_slider.*.cta_title' => ['nullable', 'string'],
            'section_6_slider.*.cta_link' => ['nullable', 'url'],
        ];
    }

    public function messages(): array
    {
        return (new MainRequest)->messages();
    }

    public function attributes(): array
    {
        return (new MainRequest)->attributes();
    }
}
