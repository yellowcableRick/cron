<?php

namespace YellowCable\Cron\Entry;

use Attribute;
use YellowCable\Cron\Entry\Field\Command\Command;
use YellowCable\Cron\Entry\Field\Command\Redirection;
use YellowCable\Cron\Entry\Field\Time\DayOfMonth;
use YellowCable\Cron\Entry\Field\Time\DayOfWeek;
use YellowCable\Cron\Entry\Field\Time\Hour;
use YellowCable\Cron\Entry\Field\Time\Minute;
use YellowCable\Cron\Entry\Field\Time\Month;
use YellowCable\Cron\Entry\Host\HostInterface;

#[Attribute(Attribute::TARGET_CLASS)]
class Yearly extends Entry
{
    public function __construct(
        public Command $command,
        public ?Redirection $redirection = null,
        public ?HostInterface $host = null,
    ) {
        parent::__construct(
            new Minute("0"),
            new Hour("0"),
            new DayOfMonth("1"),
            new Month("1"),
            new DayOfWeek("*"),
            $command,
            $redirection,
            $host
        );
    }
}
