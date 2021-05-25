<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TemplateSample メンテナンス終了時刻
    | TemplateSample maintenance end time
    |--------------------------------------------------------------------------
    | 503メンテナンス画面に表示する終了時刻。nullの場合は表示しない
    | 503 The end time displayed on the maintenance screen. If null, do not display
    | .env sample
    | MAINTENANCEEND_AT="2020-01-01 10:00:00"
    |
    */
    'maintenanceend_at' => env('MAINTENANCEEND_AT', null),
];
