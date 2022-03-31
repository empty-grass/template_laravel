<?php

namespace App\Repositories;

use App\Models\Client;
use App\Consts\ClientConst;

class ClientRepository extends BaseRepository
{
    protected $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    public function getAdminList()
    {
        return $this->model
                        ->leftJoin('client_user', 'clients.id', 'client_user.client_id')
                        ->leftJoin('users', 'users.id', 'client_user.user_id')
                        ->leftJoin('view_client_user_count', 'view_client_user_count.client_id', 'clients.id')
                        ->paginate();
    }
}
