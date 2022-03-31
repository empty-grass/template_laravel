<?php

namespace App\Consts;

/**
 * TemplateSample
 */
class UserConst
{
    /**
     * ----------------------------------------------------------------
     *  usersTBL
     * ----------------------------------------------------------------
     */
    // users.name
    const NAME_MAX = 20;

    // users.email
    const EMAIL_MIN = 6;
    const EMAIL_MAX = 256;

    /**
     * ----------------------------------------------------------------
     *  検索機能 search
     * ----------------------------------------------------------------
     */

    // route(admin.user.list)画面の検索・検索クリア・ソートボタンvalue
    const SUBMIT_KIND_SEARCH = 1;
    const SUBMIT_KIND_SORT = 2;
    const SUBMIT_KIND_CLEAR = 3;
    const SUBMIT_KIND = [
        self::SUBMIT_KIND_SEARCH,
        self::SUBMIT_KIND_SORT,
        self::SUBMIT_KIND_CLEAR,
    ];

    const SEARCH_FILTER_SESSION = 'user_search_filter';

    const PER_PAGE = 10;
}
