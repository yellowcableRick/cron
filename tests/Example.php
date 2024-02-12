<?php

namespace YellowCable\Cron\Tests;

use YellowCable\Cron\Line\Field\Command\Command;
use YellowCable\Cron\Line\Field\Time\DayOfMonth;
use YellowCable\Cron\Line\Field\Time\DayOfWeek;
use YellowCable\Cron\Line\Field\Time\Hour;
use YellowCable\Cron\Line\Field\Time\Minute;
use YellowCable\Cron\Line\Field\Time\Month;
use YellowCable\Cron\Line\Entry as CronEntry;

#[CronEntry(
    new Minute("*"),
    new Hour("*"),
    new DayOfMonth("*"),
    new Month("*"),
    new DayOfWeek("*"),
    new Command("echo test"),
    null
)]
class Example
{
}
