<?php

namespace YellowCable\Cron\Tests;

use YellowCable\Cron\Entry\Field\Command\Command;
use YellowCable\Cron\Entry\Field\Time\DayOfMonth;
use YellowCable\Cron\Entry\Field\Time\DayOfWeek;
use YellowCable\Cron\Entry\Field\Time\Hour;
use YellowCable\Cron\Entry\Field\Time\Minute;
use YellowCable\Cron\Entry\Field\Time\Month;

#[\YellowCable\Cron\Entry\Entry(
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
