<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use App\Consts\ClientConst;
use App\Repositories\ClientRepository;
use App\Exceptions\NotfoundClientException;
use App\Exceptions\ForbiddenAdminUserException;

class ClientBaseRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->client = app(ClientRepository::class);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        if (is_null($this->id)) {
            return true;
        }

        // if ($this->user()->isAdmin()) {
        //     throw new ForbiddenAdminUserException();
        // }

        if (!$this->client->existsId($this->id)) {
            throw new NotfoundClientException();
        }

        return true;
    }
}
