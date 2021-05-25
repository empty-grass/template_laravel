<?php
namespace App\Api\Backlog;

use App\Api\Backlog\BaseApi;

class GetUserIconApi extends BaseApi
{
    protected $method = 'GET';
    protected $end_point = '/users/:userId/icon';

    public function __construct()
    {
        parent::__construct();
    }

    public function setEndpoint($args)
    {
        $this->end_point = str_replace(':userId', $args['user_id'], $this->end_point);
    }
}
