<?php

namespace YellowCable\Cron\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use YellowCable\Cron\Entry\Entry;
use YellowCable\Cron\Exceptions\CronNotFoundException;

class AsAttributeTest extends TestCase
{
    /**
     * @throws CronNotFoundException
     */
    public function test(): void
    {
        $this->assertEquals(
            "* * * * * echo test ",
            (new ReflectionClass(new Example()))->getAttributes(Entry::class)[0]->newInstance()
        );

        $this->assertEquals(
            "* * * * * echo test \n0 0 * * * test ",
            (string) Example::entries()
        );
    }
}
