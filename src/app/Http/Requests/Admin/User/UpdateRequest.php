<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;
use App\Consts\UserConst;

/**
 * TemplateSample
 */
class UpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $email_unique = Rule::unique('users')->where(function ($query) {
            return $query->whereNull('deleted_at');
        })->ignore($this->id);
        return [
            'name'  => ['required', 'bail', 'min:1', 'max:'.UserConst::NAME_MAX, 'no_ctrl_chars'],
            'email' => ['required', 'bail', 'email', 'min:'.UserConst::EMAIL_MIN, 'max:'.UserConst::EMAIL_MAX, $email_unique],
        ];
    }
}
