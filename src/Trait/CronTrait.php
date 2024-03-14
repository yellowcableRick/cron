<?php

namespace YellowCable\Cron\Trait;

use ReflectionAttribute;
use ReflectionClass;
use YellowCable\Cron\Entry\Entries;
use YellowCable\Cron\Entry\Entry;
use YellowCable\Cron\Exceptions\CronNotFoundException;

trait CronTrait
{
    /**
     * @throws CronNotFoundException
     */
    public static function entries(): Entries
    {
        $entries = new Entries();
        foreach (
            (new ReflectionClass(new self()))
                ->getAttributes(Entry::class, ReflectionAttribute::IS_INSTANCEOF) as $entry
        ) {
            $entries[] = $entry->newInstance();
        }

        return count($entries) ? $entries : throw new CronNotFoundException();
    }
}
