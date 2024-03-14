<?php

namespace YellowCable\Cron\Tests;

use YellowCable\Cron\Entry\Daily;
use YellowCable\Cron\Entry\Entry;
use YellowCable\Cron\Entry\Field\Command\Command;
use YellowCable\Cron\Entry\Field\Time\{DayOfMonth, DayOfWeek, Hour, Minute, Month};
use YellowCable\Cron\Trait\CronTrait;

#[Entry(
    new Minute("*"),
    new Hour("*"),
    new DayOfMonth("*"),
    new Month("*"),
    new DayOfWeek("*"),
    new Command("echo test")
)]
#[Daily(new Command("test"))]
class Example
{
    use CronTrait;
}
