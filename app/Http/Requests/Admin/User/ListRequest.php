<?php

namespace App\Http\Requests\Admin\User;

/**
 * TemplateSamle
 */
class ListRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => ['nullable', 'bail', 'integer'],
        ];
    }
}
