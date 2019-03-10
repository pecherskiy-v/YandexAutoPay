<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class YandexAutoPayTest extends TestCase
{
    protected $fixture;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        require_once __DIR__ . '/vendor/autoload.php';
        parent::__construct($name, $data, $dataName);
    }

    protected function setUp(): void
    {
        $this->fixture = 'Pecherskiy\Yandex\AutoPay';
    }

    protected function tearDown(): void
    {
        $this->fixture = null;
    }

    /**
     * @dataProvider providerMessage
     */
    public function testParserMessage($Message, $response)
    {
        $this->assertEquals($response, $this->fixture::parserMessage($Message));
    }

    public function providerMessage()
    {
        return [
            ['Пароль: 6968
                Спишется 3339,7р.
                Перевод на счет 410012776249541',
                [
                    'pass' => '6968',
                    'sum' => '3339,7',
                    'acct' => '410012776249541',
                ],
            ],
            ['Недостаточно средств.',
                ['error' => 'Недостаточно средств.'],
            ],
            ['Сумма указана неверно.',
                ['error' => 'Сумма указана неверно.'],
            ],
            ['Пароль: 2116
                Спишется 0,21р.
                Перевод на счет 410012776249541',
                [
                    'pass' => '2116',
                    'sum' => '0,21',
                    'acct' => '410012776249541',
                ],
            ],
            ['Пароль: 6509
                Спишется 12,4р.
                Перевод на счет 410012776249541',
                [
                    'pass' => '6509',
                    'sum' => '12,4',
                    'acct' => '410012776249541',
                ],
            ],
            ['Пароль: 1900
                Спишется 12,4р.
                Перевод на счет 410012776243341',
                [
                    'pass' => '1900',
                    'sum' => '12,4',
                    'acct' => '410012776243341',
                ],
            ],
            ['Пароль: 8437
                Спишется 12,4р.
                Перевод на счет 41001277624334',
                [
                    'pass' => '8437',
                    'sum' => '12,4',
                    'acct' => '41001277624334',
                ],
            ],
            ['Кошелек Яндекс.Денег указан неверно.',
                ['error' => 'Кошелек Яндекс.Денег указан неверно.'],
            ],
        ];
    }
}
