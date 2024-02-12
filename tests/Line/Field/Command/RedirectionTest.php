<?php

namespace Line\Field\Command;

use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Line\Field\Command\Redirection;
use PHPUnit\Framework\TestCase;

class RedirectionTest extends TestCase
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
            $this->assertTrue(new Redirection($value) instanceof Redirection);
        } else {
            $this->expectException(InputNotValidException::class);
            new Redirection($value);
        }
    }

    /**
     * @return array<int, array<string|bool>>
     */
    public static function dataProvider(): array
    {
        return CommandTest::dataProvider();
    }
}
