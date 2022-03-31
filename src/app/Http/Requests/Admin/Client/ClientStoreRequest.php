<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Validation\Rule;
use App\Consts\ClientConst;

class ClientStoreRequest extends ClientBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'bail', 'min:1', 'max:'.ClientConst::NAME_MAX, 'no_ctrl_chars'],
        ];
    }
}
