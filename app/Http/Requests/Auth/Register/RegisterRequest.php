<?php

namespace App\Http\Requests\Auth\Register;

use App\Consts\UserConst;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
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
        });
        return [
            'name'     => ['required', 'bail', 'string', 'max:'.UserConst::NAME_MAX, 'no_ctrl_chars'],
            'email'    => ['required', 'bail', 'email', 'max:'.UserConst::EMAIL_MAX, $email_unique],
            'password' => ['required', 'bail', 'confirmed', 'alpha_num_symbol'],
        ];
    }

    public function attributes()
    {
        return [
            'name'     => 'ユーザ名',
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
