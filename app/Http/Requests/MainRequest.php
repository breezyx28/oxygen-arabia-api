<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class MainRequest extends FormRequest
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
    //             'hero_slider_icons',
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
            // Basic fields
            'hero_cover' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:500'],
            'hero_cta_title' => ['required', 'string', 'max:100'],
            'hero_cta_link' => ['required', 'string', 'max:255', 'url'],
            // JSON decoded arrays
            'hero_card_1' => ['required', 'array'],
            'hero_card_1.*.title' => ['required', 'string'],
            'hero_card_1.*.subtitle' => ['required', 'string'],
            // hero slider
            'hero_slider_title' => ['required', 'string', 'max:255'],
            'hero_slider_imgs' => ['required', 'array'],
            'hero_slider_imgs.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            // hero card
            'hero_card_2' => ['required', 'array'],
            'hero_card_2.*.title' => ['required', 'string'],
            'hero_card_2.*.subtitle' => ['required', 'string'],

            'section_1_title' => ['required', 'string', 'max:255'],
            'section_1_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_1_title' => ['required', 'string', 'max:255'],
            'section_1_card_1_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_1_cta' => ['required', 'string', 'max:255', 'url'],
            'section_1_card_2_title' => ['required', 'string', 'max:255'],
            'section_1_card_2_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_2_cta' => ['required', 'string', 'max:255', 'url'],
            'section_1_card_3_title' => ['required', 'string', 'max:255'],
            'section_1_card_3_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_3_cta' => ['required', 'string', 'max:255', 'url'],

            'section_2_title' => ['required', 'string', 'max:255'],
            'section_2_subtitle' => ['required', 'string', 'max:500'],
            'section_2_icons' => ['required', 'array'],
            'section_2_icons.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],

            'section_3_title' => ['required', 'string', 'max:255'],
            'section_3_card_1_icon' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'section_3_card_1_title' => ['required', 'string', 'max:255'],
            'section_3_card_1_features' => ['required', 'array'],
            'section_3_card_1_features.*' => ['required', 'string'],
            'section_3_card_1_cta' => ['required', 'string', 'max:255', 'url'],
            'section_3_card_2_icon' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'section_3_card_2_title' => ['required', 'string', 'max:255'],
            'section_3_card_2_features' => ['required', 'array'],
            'section_3_card_2_features.*' => ['required', 'string'],
            'section_3_card_2_cta' => ['required', 'string', 'max:255', 'url'],
            'section_3_card_3_icon' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'section_3_card_3_title' => ['required', 'string', 'max:255'],
            'section_3_card_3_features' => ['required', 'array'],
            'section_3_card_3_features.*' => ['required', 'string'],
            'section_3_card_3_cta' => ['required', 'string', 'max:255', 'url'],

            'section_4_cover' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'section_4_title' => ['required', 'string', 'max:255'],
            'section_4_cta_title' => ['required', 'string', 'max:100'],
            'section_4_cta_link' => ['required', 'string', 'max:255', 'url'],

            'section_5_title' => ['required', 'string', 'max:255'],
            'section_5_card_img' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'section_5_card_card' => ['required', 'array'],
            'section_5_card_card.*.title' => ['required', 'string'],
            'section_5_card_card.*.subtitle' => ['required', 'string'],

            'section_6_title' => ['required', 'string', 'max:255'],
            'section_6_slider' => ['required', 'array'],
            'section_6_slider.*.type' => ['required', 'in:img,text'],
            'section_6_slider.*.icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
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
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'url' => 'The :attribute must be a valid URL.',
            'in' => 'The :attribute must be one of the following types: :values.',
            'array' => 'The :attribute must be a valid list.',
            'image' => 'The :attribute must be an image file.',
            'mimes' => 'The :attribute must be a file of type: :values.',
        ];
    }

    public function attributes(): array
    {
        return [
            'hero_cover' => 'hero cover image',
            'hero_title' => 'hero title',
            'hero_subtitle' => 'hero subtitle',
            'hero_cta_title' => 'hero CTA title',
            'hero_cta_link' => 'hero CTA link',
            'hero_slider_title' => 'hero slider title',
            'hero_card_1' => 'hero card 1',
            'hero_card_2' => 'hero card 2',
            'hero_slider_imgs' => 'hero slider images',
            'section_1_title' => 'section 1 title',
            'section_1_subtitle' => 'section 1 subtitle',
            'section_2_title' => 'section 2 title',
            'section_2_subtitle' => 'section 2 subtitle',
            'section_2_icons' => 'section 2 icons',
            'section_3_title' => 'section 3 title',
            'section_3_card_1_icon' => 'section 3 card 1 icon',
            'section_3_card_1_title' => 'section 3 card 1 title',
            'section_3_card_1_cta' => 'section 3 card 1 CTA',
            'section_3_card_1_features' => 'section 3 card 1 features',
            'section_3_card_2_icon' => 'section 3 card 2 icon',
            'section_3_card_2_title' => 'section 3 card 2 title',
            'section_3_card_2_cta' => 'section 3 card 2 CTA',
            'section_3_card_2_features' => 'section 3 card 2 features',
            'section_3_card_3_icon' => 'section 3 card 3 icon',
            'section_3_card_3_title' => 'section 3 card 3 title',
            'section_3_card_3_cta' => 'section 3 card 3 CTA',
            'section_3_card_3_features' => 'section 3 card 3 features',
            'section_4_cover' => 'section 4 cover',
            'section_4_title' => 'section 4 title',
            'section_4_cta_title' => 'section 4 CTA title',
            'section_4_cta_link' => 'section 4 CTA link',
            'section_5_title' => 'section 5 title',
            'section_5_card_img' => 'section 5 card image',
            'section_5_card_card' => 'section 5 card card',
            'section_6_title' => 'section 6 title',
            'section_6_slider' => 'section 6 slider',
        ];
    }
}
