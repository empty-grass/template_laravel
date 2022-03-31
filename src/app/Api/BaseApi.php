<?php

namespace App\Api;

class BaseApi
{
    protected $base_url;
    protected $method;
    protected $end_point;
    protected $request_header = [];
    protected $request_query = [];
    protected $request_body = [];

    public function __construct()
    {
        //
    }

    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getEndpoint()
    {
        return $this->end_point;
    }

    public function getRequestHeader()
    {
        return $this->request_header;
    }

    public function getRequestQuery()
    {
        return $this->request_query;
    }

    public function getRequestBody()
    {
        return $this->request_body;
    }

    public function setEndPoint($args)
    {
        //
    }

    public function setRequestQuery($args)
    {
        //
    }

    public function setRequestBody($args)
    {
        //
    }
}
