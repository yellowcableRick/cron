<?php

namespace YellowCable\Cron\Line;

use Attribute;
use YellowCable\Cron\Line\Field\Command\Command;
use YellowCable\Cron\Line\Field\Command\Redirection;
use YellowCable\Cron\Line\Field\Time\DayOfMonth;
use YellowCable\Cron\Line\Field\Time\DayOfWeek;
use YellowCable\Cron\Line\Field\Time\Hour;
use YellowCable\Cron\Line\Field\Time\Minute;
use YellowCable\Cron\Line\Field\Time\Month;

#[Attribute(Attribute::TARGET_CLASS)]
class Entry
{
    public function __construct(
        public readonly Minute $minutes,
        public readonly Hour $hours,
        public readonly DayOfMonth $dom,
        public readonly Month $month,
        public readonly DayOfWeek $dow,
        public readonly Command $command,
        public readonly ?Redirection $redirection,
    ) {
    }

    public function __toString(): string
    {
        return "$this->minutes $this->hours $this->dom $this->month $this->dow $this->command $this->redirection";
    }
}
