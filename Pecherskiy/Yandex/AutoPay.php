<?php

namespace Pecherskiy\Yandex;

class AutoPay
{
    /* ------------------ Parser Message ------------------
     * на входе получаем текст смс
     * на выходе массив:
     *  - пароль
     *  - сумма
     *  - номер счета\кошелька
     */
    public static function parserMessage($message)
    {
        $patternSum = "/.*\s(\d*,\d{1,2}).*/mix";
        $patternPass = "/.*(\d{4}.*).*/mix";
        $patternAcct = "/.*(41001\d{8,10}).*/mix";

        preg_match_all($patternSum, $message, $sum_array);
        preg_match_all($patternPass, $message, $pass_array);
        preg_match_all($patternAcct, $message, $acct_array);

        if (!isset($pass_array[1][0]) || !isset($sum_array[1][0]) || !isset($acct_array[1][0])) {
            return ['error' => $message];
        }

        return [
            'pass' => $pass_array[1][0],
            'sum' => $sum_array[1][0],
            'acct' => $acct_array[1][0],
        ];
    }
}
