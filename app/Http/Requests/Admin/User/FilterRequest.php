<?php

namespace App\Http\Requests\Admin\User;

/**
 * TemplateSample
 */
class FilterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['nullable', 'bail', 'no_ctrl_chars'],
            'email' => ['nullable', 'bail', 'email'],
        ];
    }
}
