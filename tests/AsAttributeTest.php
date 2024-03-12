<?php

namespace YellowCable\Cron\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use YellowCable\Cron\Entry\Entry;

class AsAttributeTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            "* * * * * echo test ",
            (new ReflectionClass(new Example()))->getAttributes(Entry::class)[0]->newInstance()
        );
    }
}
