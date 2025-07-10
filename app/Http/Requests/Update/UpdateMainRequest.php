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

    public function prepareForValidation(): void
    {
        // ✅ Cast booleans from string to actual boolean
        foreach (
            [
                'section_1_active',
                'section_2_active',
                'section_3_active',
                'section_4_active',
                'section_5_active',
                'section_6_active',
                // 'hero_card_1_active',
                // 'hero_card_2_active',
                // 'hero_slider_active',
            ] as $boolField
        ) {
            if ($this->has($boolField)) {
                $value = $this->input($boolField);
                $this->merge([
                    $boolField => filter_var($value, FILTER_VALIDATE_BOOLEAN),
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [

            // Strings – optional, so we use sometimes
            'hero_title' => ['sometimes', 'string', 'max:255'],
            'hero_subtitle' => ['sometimes', 'string', 'max:500'],
            'hero_cta_title' => ['sometimes', 'string', 'max:100'],
            'hero_cta_link' => ['sometimes', 'string', 'max:255', 'url'],
            'hero_slider_title' => ['sometimes', 'string', 'max:255'],

            // JSON Arrays
            // 'hero_card_1_active' => ['sometimes', 'boolean'],
            'hero_card_1' => ['sometimes', 'nullable', 'array'],
            'hero_card_1.*.title' => ['sometimes', 'string'],
            'hero_card_1.*.subtitle' => ['sometimes', 'string'],

            // 'hero_card_2_active' => ['sometimes', 'boolean'],
            'hero_card_2' => ['sometimes', 'array'],
            'hero_card_2.*.title' => ['sometimes', 'string'],
            'hero_card_2.*.subtitle' => ['sometimes', 'string'],

            // 'hero_slider_active' => ['sometimes', 'boolean'],
            'hero_slider_imgs' => ['sometimes', 'nullable', 'array'],
            'hero_slider_imgs.*' => ['sometimes', 'string'],


            'section_1_active' => ['sometimes', 'boolean'],
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

            'section_2_active' => ['sometimes', 'boolean'],
            'section_2_title' => ['sometimes', 'string', 'max:255'],
            'section_2_subtitle' => ['sometimes', 'string', 'max:500'],

            'section_3_active' => ['sometimes', 'boolean'],
            'section_3_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_1_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_1_cta' => ['sometimes', 'string', 'max:255', 'url'],
            'section_3_card_2_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_2_cta' => ['sometimes', 'string', 'max:255', 'url'],
            'section_3_card_3_title' => ['sometimes', 'string', 'max:255'],
            'section_3_card_3_cta' => ['sometimes', 'string', 'max:255', 'url'],

            'section_4_active' => ['sometimes', 'boolean'],
            'section_4_title' => ['sometimes', 'string', 'max:255'],
            'section_4_cta_title' => ['sometimes', 'string', 'max:100'],
            'section_4_cta_link' => ['sometimes', 'string', 'max:255', 'url'],

            'section_5_active' => ['sometimes', 'boolean'],
            'section_5_title' => ['sometimes', 'string', 'max:255'],

            'section_6_active' => ['sometimes', 'boolean'],
            'section_6_title' => ['sometimes', 'string', 'max:255'],


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

            // Images – make them optional
            'hero_cover' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'section_3_card_1_icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'section_3_card_2_icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'section_3_card_3_icon' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'section_4_cover' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'section_5_card_img' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],

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
