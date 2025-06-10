<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class MainRequest extends FormRequest
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
            // Hero Section
            'hero_cover' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:500'],
            'hero_cta_title' => ['required', 'string', 'max:100'],
            'hero_cta_link' => ['required', 'string', 'max:255', 'url'],

            // Hero Card 1
            'hero_card_1' => ['required', 'string', 'json'],

            // Hero Slider
            'hero_slider_title' => ['required', 'string', 'max:255'],
            'hero_slider_imgs' => ['required', 'string', 'json'],

            // Hero Card 2
            'hero_card_2' => ['required', 'string', 'json'],

            // Section 1
            'section_1_title' => ['required', 'string', 'max:255'],
            'section_1_subtitle' => ['required', 'string', 'max:500'],

            // Section 1 Card 1
            'section_1_card_1_title' => ['required', 'string', 'max:255'],
            'section_1_card_1_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_1_cta' => ['required', 'string', 'max:255', 'url'],

            // Section 1 Card 2
            'section_1_card_2_title' => ['required', 'string', 'max:255'],
            'section_1_card_2_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_2_cta' => ['required', 'string', 'max:255', 'url'],

            // Section 1 Card 3
            'section_1_card_3_title' => ['required', 'string', 'max:255'],
            'section_1_card_3_subtitle' => ['required', 'string', 'max:500'],
            'section_1_card_3_cta' => ['required', 'string', 'max:255', 'url'],

            // Section 2
            'section_2_title' => ['required', 'string', 'max:255'],
            'section_2_subtitle' => ['required', 'string', 'max:500'],
            'section_2_icons' => ['required', 'string', 'json'],

            // Section 3
            'section_3_title' => ['required', 'string', 'max:255'],

            // Section 3 Card 1
            'section_3_card_1_icon' => ['required', 'string', 'max:255'],
            'section_3_card_1_title' => ['required', 'string', 'max:255'],
            'section_3_card_1_features' => ['required', 'string', 'json'],
            'section_3_card_1_cta' => ['required', 'string', 'max:255', 'url'],

            // Section 3 Card 2
            'section_3_card_2_icon' => ['required', 'string', 'max:255'],
            'section_3_card_2_title' => ['required', 'string', 'max:255'],
            'section_3_card_2_features' => ['required', 'string', 'json'],
            'section_3_card_2_cta' => ['required', 'string', 'max:255', 'url'],

            // Section 3 Card 3
            'section_3_card_3_icon' => ['required', 'string', 'max:255'],
            'section_3_card_3_title' => ['required', 'string', 'max:255'],
            'section_3_card_3_features' => ['required', 'string', 'json'],
            'section_3_card_3_cta' => ['required', 'string', 'max:255', 'url'],

            // Section 4
            'section_4_cover' => ['required', 'string', 'max:255'],
            'section_4_title' => ['required', 'string', 'max:255'],
            'section_4_cta_title' => ['required', 'string', 'max:100'],
            'section_4_cta_link' => ['required', 'string', 'max:255', 'url'],

            // Section 5
            'section_5_title' => ['required', 'string', 'max:255'],
            'section_5_card_img' => ['required', 'string', 'max:255'],
            'section_5_card_card' => ['required', 'string', 'json'],

            // Section 6
            'section_6_title' => ['required', 'string', 'max:255'],
            'section_6_slider' => ['required', 'string', 'json'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'url' => 'The :attribute must be a valid URL.',
            'json' => 'The :attribute must be a valid JSON string.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'hero_cover' => 'Hero Cover Image',
            'hero_title' => 'Hero Title',
            'hero_subtitle' => 'Hero Subtitle',
            'hero_cta_title' => 'Hero CTA Title',
            'hero_cta_link' => 'Hero CTA Link',
            'hero_card_1' => 'Hero Card 1',
            'hero_slider_title' => 'Hero Slider Title',
            'hero_slider_imgs' => 'Hero Slider Images',
            'hero_card_2' => 'Hero Card 2',
            'section_1_title' => 'Section 1 Title',
            'section_1_subtitle' => 'Section 1 Subtitle',
            'section_1_card_1_title' => 'Section 1 Card 1 Title',
            'section_1_card_1_subtitle' => 'Section 1 Card 1 Subtitle',
            'section_1_card_1_cta' => 'Section 1 Card 1 CTA',
            'section_1_card_2_title' => 'Section 1 Card 2 Title',
            'section_1_card_2_subtitle' => 'Section 1 Card 2 Subtitle',
            'section_1_card_2_cta' => 'Section 1 Card 2 CTA',
            'section_1_card_3_title' => 'Section 1 Card 3 Title',
            'section_1_card_3_subtitle' => 'Section 1 Card 3 Subtitle',
            'section_1_card_3_cta' => 'Section 1 Card 3 CTA',
            'section_2_title' => 'Section 2 Title',
            'section_2_subtitle' => 'Section 2 Subtitle',
            'section_2_icons' => 'Section 2 Icons',
            'section_3_title' => 'Section 3 Title',
            'section_3_card_1_icon' => 'Section 3 Card 1 Icon',
            'section_3_card_1_title' => 'Section 3 Card 1 Title',
            'section_3_card_1_features' => 'Section 3 Card 1 Features',
            'section_3_card_1_cta' => 'Section 3 Card 1 CTA',
            'section_3_card_2_icon' => 'Section 3 Card 2 Icon',
            'section_3_card_2_title' => 'Section 3 Card 2 Title',
            'section_3_card_2_features' => 'Section 3 Card 2 Features',
            'section_3_card_2_cta' => 'Section 3 Card 2 CTA',
            'section_3_card_3_icon' => 'Section 3 Card 3 Icon',
            'section_3_card_3_title' => 'Section 3 Card 3 Title',
            'section_3_card_3_features' => 'Section 3 Card 3 Features',
            'section_3_card_3_cta' => 'Section 3 Card 3 CTA',
            'section_4_cover' => 'Section 4 Cover',
            'section_4_title' => 'Section 4 Title',
            'section_4_cta_title' => 'Section 4 CTA Title',
            'section_4_cta_link' => 'Section 4 CTA Link',
            'section_5_title' => 'Section 5 Title',
            'section_5_card_img' => 'Section 5 Card Image',
            'section_5_card_card' => 'Section 5 Card',
            'section_6_title' => 'Section 6 Title',
            'section_6_slider' => 'Section 6 Slider',
        ];
    }
}
