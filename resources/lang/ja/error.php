<?php

// Template
return [
    'exception' => [
        'Authentication' => [
            'expired' => '長時間放置によりセッションが切れました。お手数ですが再度ログインをお願いします。',
            'json' => 'ログインセッションが切れました。お手数ですが再度ログイン後操作をやり直してください。',
        ],
        'ForbiddenAdminUser' => '管理画面へのアクセス権限がありません。',
        'ForbiddenAdminUserNoSession' => 'ユーザ情報が見つからないため、このページを閲覧することができません。',
        'MaintenanceMode' => '只今メンテナンス中です。システム再開は :datetime を予定しています。',
        'MaintenanceModeNoDatetime' => '只今メンテナンス中です。',

        // TemplateSample
        'NotfoundClient' => '指定のクライアントは存在しないか削除済みです。',
        // TemplateSample
        'NotfoundUser' => '指定のユーザは存在しません。',

        // Template
        'Validation' => '入力に誤りがあります。',
    ],
    'http' => [
        '403' => [
            'title' => 'Forbidden',
            'message' => 'この画面へのアクセス権限がありません。',
        ],
        '404' => [
            'title' => 'Not Found',
            'message' => 'ご指定のURLの画面が見つかりません。',
        ],
        '405' => [
            'title' => 'Method Not Allowed',
            'message' => 'アクセスが不正です。',
        ],
        '419' => [
            'title' => 'Session Timeout',
            'message' => '長時間放置によりセッションが切れました。お手数ですが操作のやり直しをお願いします。',
        ],
        '500' => [
            'title' => 'Server Error',
            'message' => '申し訳ございません。何らかのシステム不具合により処理が中断されました。',
        ],
        '501' => [
            'title' => 'Server Error',
            'message' => '申し訳ございません。何らかの問題により処理が中断されました。',
        ],
        '503' => [
            'title' => 'Service Unavailable',
        ],
    ],
];
