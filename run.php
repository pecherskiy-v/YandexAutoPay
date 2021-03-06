<?php
// include_once 'Yandex\AutoPay.php';
require_once __DIR__ . '/vendor/autoload.php';

use Pecherskiy\Yandex\AutoPay;

$msgArray = [
    'Пароль: 6968
    Спишется 3339,7р.
    Перевод на счет 410012776249541',
    'Недостаточно средств.',
    'Сумма указана неверно.',
    'Пароль: 2116
    Спишется 0,21р.
    Перевод на счет 410012776249541',
    'Пароль: 6509
    Спишется 12,4р.
    Перевод на счет 410012776249541',
    'Пароль: 1900
    Спишется 12,4р.
    Перевод на счет 410012776243341',
    'Пароль: 8437
    Спишется 12,4р.
    Перевод на счет 41001277624334',
    'Кошелек Яндекс.Денег указан неверно.',
];

foreach ($msgArray as $value) {
    $result = AutoPay::parserMessage($value);
    var_dump($result);
}
