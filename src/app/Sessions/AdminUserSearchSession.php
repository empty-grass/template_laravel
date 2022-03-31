<?php
namespace App\Sessions;

use App\Consts\UserConst;

/**
 * TemplateSample
 */
class AdminUserSearchSession extends BaseSession
{
    protected $name;

    public function __construct()
    {
        $this->name = UserConst::SEARCH_FILTER_SESSION;
    }
}
