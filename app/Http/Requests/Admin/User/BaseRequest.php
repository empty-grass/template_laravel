<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\UserRepository;
use App\Exceptions\NotfoundUserException;

/**
 * TemplateSample
 */
class BaseRequest extends FormRequest
{

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->user = app(UserRepository::class);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        if (is_null($this->id)) {
            return true;
        }

        if (!$this->user->existsId($this->id)) {
            throw new NotfoundUserException();
        }

        return true;
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
