<?php

namespace App\Http\Requests\Auth\Register;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
}
