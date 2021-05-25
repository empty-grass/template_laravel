<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Api\BaseApi;

/**
 * API実行サービス
 */
class BacklogApiService extends GuzzleApiService
{
    protected $api;
    protected $response_status_code;
    protected $response_header;
    protected $response_body;

    public function __construct()
    {
        parent::__construct();
    }

    public function exeBacklogApi(BaseApi $api)
    {
        $this->exeApi($api);
        // TODO エラー処理
        return $this;
    }
}
