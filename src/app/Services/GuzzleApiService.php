<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Api\BaseApi;

/**
 * API実行サービス
 */
class GuzzleApiService
{
    protected $api;
    protected $response_status_code;
    protected $response_header;
    protected $response_query;
    protected $response_body;

    public function __construct()
    {
        $this->guzzle = new Client;
    }

    public function exeApi(BaseApi $api)
    {
        $url = $api->getBaseUrl() . $api->getEndpoint();
        $content = [
            'headers' => $api->getRequestHeader(),
            'query' => $api->getRequestQuery(),
            'form_params' => $api->getRequestBody(),
        ];

        $res = $this->guzzle->request($api->getMethod(), $url, $content);


        $this->response_status_code = $res->getStatusCode();
        $this->response_body = $res->getBody();
    }

    public function getResponseStatusCode()
    {
        return $this->response_status_code;
    }

    public function getResponseBody()
    {
        return json_decode($this->response_body, true);
    }

    public function getResponseResouce()
    {
        return $this->response_body;
    }
}
