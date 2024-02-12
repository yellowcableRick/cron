<?php

namespace Line\Field\Time;

use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Line\Field\Time\DayOfMonth;
use PHPUnit\Framework\TestCase;

class DayOfMonthTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $value
     * @param bool   $result
     * @return void
     * @throws InputNotValidException
     * @throws ValidatorNotFoundException
     */
    public function test(string $value, bool $result): void
    {
        if ($result) {
            $this->assertTrue(new DayOfMonth($value) instanceof DayOfMonth);
        } else {
            $this->expectException(InputNotValidException::class);
            new DayOfMonth($value);
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
            ["05", true],
            ["05-10", true],
            ["22", true],
            ["11,22", true],
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
            ["24", true],
            ["91", false],
            ["13,", false],
            ["22,22,,", false],
        ];
    }
}
