<?php

namespace App\Api\Backlog;

use App\Api\BaseApi as Api;

class BaseApi extends Api
{
    protected $base_url;
    protected $method;
    protected $end_point;
    protected $request_header;
    protected $request_query;

    public function __construct()
    {
        $this->base_url = config('api.backlog.base_url');
        $this->setRequestHeader();
        $this->setRequestQuery([]);
    }

    protected function setRequestHeader()
    {
        $this->request_header = [
            'Accept' => 'application/json',
        ];
    }

    public function setRequestQuery($args)
    {
        $this->request_query = [
            'apiKey' => config('api.backlog.apiKey'),
        ];
    }
}
