<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Validation\Rule;
use App\Consts\ClientConst;

class ClientEditRequest extends ClientBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
