<?php

namespace YellowCable\Cron\Tests\Entry\Field\Command;

use PHPUnit\Framework\Attributes\DataProvider;
use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Entry\Field\Command\Command;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
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
            $this->assertTrue(new Command($value) instanceof Command);
        } else {
            $this->expectException(InputNotValidException::class);
            new Command($value);
        }
    }

    public function testEscapePercentage(): void
    {
        $this->assertEquals("echo \%bliep", (string) (new Command("echo %bliep"))->escapePercentage());
    }

    /**
     * @return array<int, array<string|bool>>
     */
    public static function dataProvider(): array
    {
        return [
            ["0123456789", true],
            ["abcdefghijklmnopqrstuvwxyz", true],
            ["ABCDEFGHIJKLMNOPQRSTUVWXYZ", true],
            [" ", true],
            ["!", true],
            ["@", true],
            ["#", true],
            ["$", true],
            ["%", true],
            ["^", true],
            ["&", true],
            ["*", true],
            ["()", true],
            ["_", true],
            ["-", true],
            ["+", true],
            ["=", true],
            ["~", true],
            ["`", true],
            ["'", true],
            ["\"", true],
            ["?!", true],
            ["\\/", true],
            ["<>", true],
            ["'", true],
            [",.", true],
            ["{}", true],
            ["[]", true],
            ["$", true],
            ["\x7F", false],
            ["₿", false],
            ["€", false],
            ["Đ", false],
            [" ", false],
            ["", false],
            ["§", false],
            ["©®", false],
            ["¿", false],
        ];
    }
}
