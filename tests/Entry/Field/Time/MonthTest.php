<?php

namespace YellowCable\Cron\Tests\Entry\Field\Time;

use PHPUnit\Framework\Attributes\DataProvider;
use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Entry\Field\Time\Month;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    /**
     * @param string $value
     * @param bool   $result
     * @return void
     * @throws InputNotValidException
     * @throws ValidatorNotFoundException
     */
    #[DataProvider("dataProvider")]
    public function test(string $value, bool $result): void
    {
        if ($result) {
            $this->assertTrue(new Month($value) instanceof Month);
        } else {
            $this->expectException(InputNotValidException::class);
            new Month($value);
        }
    }

    /**
     * @return array<int, array<string|bool>>
     */
    public static function dataProvider(): array
    {
        return [
            ["0", false],
            ["1", true],
            ["2", true],
            ["00", false],
            ["05", false],
            ["5-10", true],
            ["12", true],
            ["33", false],
            ["33,44,55", false],
            ["*/2", true],
            ["*/3", true],
            ["*/4", true],
            ["*/5", true],
            ["*/6", true],
            ["*/10", true],
            ["*/12", true],
            ["*/15", true],
            ["*/20", true],
            ["*/30", true],
            ["55/5", false],
            ["00-99", false],
            ["00-", false],
            ["91", false],
            ["13,", false],
            ["22,22,,", false],
            ["JAN", true],
            ["FEB,MAR", true],
            ["BLE", false],
            ["BLE,fe3fwe,", false],
            ["JAN,,,", false],
        ];
    }
}
