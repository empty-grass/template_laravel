<?php
namespace App\Http\Controllers;

use App\Services\BacklogApiService;
use App\Api\Backlog\GetUserMyselfApi;
use App\Api\Backlog\GetUserIconApi;
use Storage;

class MypageLogic
{
    public function __construct()
    {
        $this->api_service = app()->make(BacklogApiService::class);
        $this->getUserMyselfApi = app()->make(GetUserMyselfApi::class);
        $this->getUserIconApi = app()->make(GetUserIconApi::class);
    }

    public function getBacklogUser()
    {
        $response = $this->api_service->exeBacklogApi($this->getUserMyselfApi)->getResponseBody();

        $this->getUserIconApi->setEndpoint(['user_id' => $response['id']]);
        $icon = $this->api_service->exeBacklogApi($this->getUserIconApi)->getResponseResouce();

        $user_id = auth()->user()->id;
        Storage::put("/icon/{$user_id}/", $icon);
    }
}
