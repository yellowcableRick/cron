<?php

namespace YellowCable\Cron\Tests\Entry;

use YellowCable\Cron\Entry\Daily;
use YellowCable\Cron\Entry\Entries;
use PHPUnit\Framework\TestCase;
use YellowCable\Cron\Entry\Field\Command\Command;
use YellowCable\Cron\Entry\Host\Host;
use YellowCable\Cron\Entry\Host\Localhost;
use YellowCable\Cron\Entry\Weekly;

class EntriesTest extends TestCase
{
    public function test(): void
    {
        $entries = new Entries();
        $entries[] = new Daily(command: new Command("test"), host: new Localhost());
        $this->assertEquals("0 0 * * * test ", (string) $entries);

        $entries[] = new Weekly(command: new Command("test"), host: new Localhost());
        $this->assertEquals("0 0 * * * test \n0 0 * * 0 test ", (string) $entries);

        $entries[] = new Daily(command: new Command("test"), host: $otherHost = new class ("otherHost") extends Host {
        });
        $this->assertEquals("0 0 * * * test ", (string) $entries->getHostSplit($otherHost));
        $this->assertEquals("0 0 * * * test \n0 0 * * 0 test ", (string) $entries->getHostSplit(new Localhost()));
    }
}
