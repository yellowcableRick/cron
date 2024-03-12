<?php

namespace YellowCable\Cron\Tests\Entry\Field\Command;

use PHPUnit\Framework\Attributes\DataProvider;
use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Entry\Field\Command\Redirection;
use PHPUnit\Framework\TestCase;

class RedirectionTest extends TestCase
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
