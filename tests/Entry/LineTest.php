<?php

namespace YellowCable\Cron\Tests\Entry;

use YellowCable\Cron\Entry\Annually;
use YellowCable\Cron\Entry\Daily;
use YellowCable\Cron\Entry\Field\Command\Command;
use YellowCable\Cron\Entry\Field\Command\Redirection;
use YellowCable\Cron\Entry\Field\Time\DayOfMonth;
use YellowCable\Cron\Entry\Field\Time\DayOfWeek;
use YellowCable\Cron\Entry\Field\Time\Hour;
use YellowCable\Cron\Entry\Field\Time\Minute;
use YellowCable\Cron\Entry\Field\Time\Month;
use YellowCable\Cron\Entry\Entry;
use PHPUnit\Framework\TestCase;
use YellowCable\Cron\Entry\Hourly;
use YellowCable\Cron\Entry\Midnight;
use YellowCable\Cron\Entry\Monthly;
use YellowCable\Cron\Entry\Weekly;
use YellowCable\Cron\Entry\Yearly;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
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

        $this->assertEquals("0 0 1 1 * echo test ", (string) new Yearly(
            new Command("echo test"),
            null
        ));

        $this->assertEquals("0 0 1 1 * echo test ", (string) new Annually(
            new Command("echo test"),
            null
        ));

        $this->assertEquals("0 0 1 * * echo test ", (string) new Monthly(
            new Command("echo test"),
            null
        ));

        $this->assertEquals("0 0 * * 0 echo test ", (string) new Weekly(
            new Command("echo test"),
            null
        ));

        $this->assertEquals("0 0 * * * echo test ", (string) new Daily(
            new Command("echo test"),
            null
        ));

        $this->assertEquals("0 0 * * * echo test ", (string) new Midnight(
            new Command("echo test"),
            null
        ));

        $this->assertEquals("0 * * * * echo test ", (string) new Hourly(
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
