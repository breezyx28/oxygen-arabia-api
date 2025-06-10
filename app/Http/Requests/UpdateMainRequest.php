<?php

namespace App\Http\Requests;

use App\Http\Traits\CustomeErrorResponse;

class UpdateMainRequest extends MainRequest
{
    use CustomeErrorResponse;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();

        // Make all rules optional by adding 'sometimes' to each rule
        return array_map(function ($rule) {
            if (is_array($rule)) {
                array_unshift($rule, 'sometimes');
            } else {
                $rule = ['sometimes', $rule];
            }
            return $rule;
        }, $rules);
    }
}
