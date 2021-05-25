<?php
namespace App\Validators;

class CustomValidator
{
    /**
     * no_ctrl_chars
     * 制御文字が含まれていないことをバリデートします。
     * Validate that no control characters are included.
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateNoControlCharacters($attribute, $value, $parameters)
    {
        return is_string($value) && mb_ereg('\A[[:^cntrl:]]*\z', $value);
    }

    /**
     * no_ctrl_chars_excluding_tab_lf
     * タブと改行を除く制御文字が含まれていないことをバリデートします。
     * Validate that it does not contain any control characters except tabs and newlines.
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateNoControlCharactersExcludingTabLf($attribute, $value, $parameters)
    {
        return is_string($value) && mb_ereg('\A[\r\n\t[:^cntrl:]]+\z', $value);
    }

    /**
     * alpha_num_symbol
     * フィールドが全て半角英数字記号であることをバリデートします。(半角スペースも含む)
     * Validate that the fields are all alphanumeric symbols. (Including spaces)
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return boolean
     */
    public function validateHalfAlphaNumSymbol($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match('/^[ -~]+$/u', $value);
    }

    /**
     * alpha_custom
     * 既存のルールだと全角日本語も許容してしまうため、新たなルールを作成
     * Since existing rules also allow full-width Japanese, create new rules
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateAlphaCustom($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[a-z]+$/i", $value);
    }

    /**
     * alpha_dash_custom
     * 既存のルールだと全角日本語も許容してしまうため、新たなルールを作成
     * Since existing rules also allow full-width Japanese, create new rules
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateAlphaDashCustom($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[a-z0-9_-]+$/i", $value);
    }

    /**
     * alpha_num_custom
     * 既存のルールだと全角日本語も許容してしまうため、新たなルールを作成
     * Since existing rules also allow full-width Japanese, create new rules
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateAlphaNumCustom($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[a-z0-9]+$/i", $value);
    }

    /**
     * zenkaku_kana
     * 全角カナ文字のみ許容する
     * Allow only full-width kana characters
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateZenkakuKana($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[ァ-ヶ]+$/u", $value);
    }

    /**
     * is_http
     * http://~ ,もしくはhttps://~ のみ許容する。既存のルール(url)だと、file://~ なども許容されてしまうため。
     * With existing rules (url), file://~ etc. are also allowed. Using this, only http://~, or https://~ is allowed.
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateIsHttp($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^https?\:\/\/.+$/i", $value);
    }

    /**
     * hiragana
     * Allow full-width hiragana characters
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateHiragana($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[ぁ-ん]+$/u", $value);
    }

    /**
     * hiragana_with_space
     * Allow full-width hiragana characters and space(full-width, half-width)
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateHiraganaWithSpace($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[ぁ-ん 　]+$/u", $value);
    }

    /**
     * zenkaku_kana_with_space
     * 全角カナとスペース文字のみ許容する
     * Allow full-width kana characters and space(full-width, half-width)
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function validateZenkakuKanaWithSpace($attribute, $value, $parameters)
    {
        return is_string($value) && preg_match("/^[ァ-ヶ 　]+$/u", $value);
    }
}
