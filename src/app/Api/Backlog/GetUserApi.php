<?php
namespace App\Api\Backlog;

use App\Api\Backlog\BaseApi;

class GetUserApi extends BaseApi
{
    protected $method = 'GET';
    protected $end_point = '/users/:userId';

    public function __construct()
    {
        parent::__construct();
    }

    public function setEndpoint($args)
    {
        $this->end_point = str_replace(':userId', $args['user_id'], $this->end_point);
    }

    public function setRequestBody($args)
    {
        $this->request_body = [
        ];
    }
}
