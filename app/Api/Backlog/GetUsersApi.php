<?php
namespace App\Api\Backlog;

use App\Api\Backlog\BaseApi;

class GetUsersApi extends BaseApi
{
    protected $method = 'GET';
    protected $end_point = '/users';

    public function __construct()
    {
        parent::__construct();
    }

    public function setRequestBody($args)
    {
        $this->request_body = [
        ];
    }
}
