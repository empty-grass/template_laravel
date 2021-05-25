<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * TemplateSample
 */
class NotfoundUserException extends Exception
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
        return abort(Response::HTTP_NOT_FOUND, __('error.exception.NotfoundUser'));
    }
}
