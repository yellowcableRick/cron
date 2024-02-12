<?php

namespace Line;

use YellowCable\Cron\Line\Field\Command\Command;
use YellowCable\Cron\Line\Field\Command\Redirection;
use YellowCable\Cron\Line\Field\Time\DayOfMonth;
use YellowCable\Cron\Line\Field\Time\DayOfWeek;
use YellowCable\Cron\Line\Field\Time\Hour;
use YellowCable\Cron\Line\Field\Time\Minute;
use YellowCable\Cron\Line\Field\Time\Month;
use YellowCable\Cron\Line\Entry;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals("* * * * * echo test ", (string) new Entry(
            new Minute("*"),
            new Hour("*"),
            new DayOfMonth("*"),
            new Month("*"),
            new DayOfWeek("*"),
            new Command("echo test"),
            null
        ));

        $this->assertEquals("* * * * * echo test >> /tmp/bliep.log 2>&1", (string) new Entry(
            new Minute("*"),
            new Hour("*"),
            new DayOfMonth("*"),
            new Month("*"),
            new DayOfWeek("*"),
            new Command("echo test"),
            (new Redirection("/tmp/bliep.log"))->setStrategy("append")->setRedirectErrToStdOut(true)
        ));
    }
}
