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
use YellowCable\Cron\Exceptions\HostNotFoundException;

#[Attribute(Attribute::TARGET_CLASS)]
class Entry
{
    public function __construct(
        public Minute $minutes,
        public Hour $hours,
        public DayOfMonth $dom,
        public Month $month,
        public DayOfWeek $dow,
        public Command $command,
        public ?Redirection $redirection = null,
        public ?HostInterface $host = null,
    ) {
    }

    public function __toString(): string
    {
        return "$this->minutes $this->hours $this->dom $this->month $this->dow $this->command $this->redirection";
    }

    /**
     * @throws HostNotFoundException
     */
    public function getHost(): HostInterface
    {
        return $this->host ?? throw new HostNotFoundException();
    }
}
