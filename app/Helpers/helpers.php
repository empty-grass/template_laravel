<?php

if (!function_exists('ebr')) {
    /**
     * エスケープし、\n等の改行を<br>へ変換する。 {!! ebr($string) !!}
     * @param  string|null $multi_text
     * @return string
     */
    function ebr(string $multi_text = null)
    {
        return nl2br(htmlspecialchars($multi_text), false);
    }
}
