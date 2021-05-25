<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ForbiddenAdminUserNoSessionException extends Exception
{
    /**
     * 例外のレポート
     * Exception Report
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * 例外をＨＴＴＰレスポンスへレンダ
     * Render exception to HTTP response
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        return abort(Response::HTTP_FORBIDDEN, __('error.exception.ForbiddenAdminUserNoSession'));
    }
}
