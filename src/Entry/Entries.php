<?php

namespace YellowCable\Cron\Entry;

use YellowCable\Collection\Interfaces\CollectionInterface;
use YellowCable\Collection\Traits\Addons\Manipulation\SplitTrait;
use YellowCable\Collection\Traits\CollectionTrait;
use YellowCable\Cron\Entry\Host\Host;
use YellowCable\Cron\Exceptions\HostNotFoundException;

/**
 * @implements CollectionInterface<Entry>
 */
class Entries implements CollectionInterface
{
    /** @use CollectionTrait<Entry> */
    use CollectionTrait;
    /** @use SplitTrait<Entry> */
    use SplitTrait;

    public function getClass(): string
    {
        return Entry::class;
    }

    public function __toString(): string
    {
        return implode("\n", $this->collection);
    }

    public function getHostSplit(Host $host): self
    {
        return $this->split(function (Entry $x) {
            try {
                return $x->getHost()->getHostname();
            } catch (HostNotFoundException) {
                return "";
            }
        })->getItemByPrimaryKey($host->getHostname(), self::class);
    }
}
