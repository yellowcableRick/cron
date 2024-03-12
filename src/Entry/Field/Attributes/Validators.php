<?php

namespace YellowCable\Cron\Entry\Field\Attributes;

use YellowCable\Collection\Interfaces\CollectionInterface;
use YellowCable\Collection\Traits\CollectionTrait;

/**
 * @implements CollectionInterface<Validator>
 */
class Validators implements CollectionInterface
{
    /** @use CollectionTrait<Validator> */
    use CollectionTrait;

    /**
     * @param iterable<Validator> $source
     */
    public function __construct(iterable $source)
    {
        $this->setCollection($source);
    }

    public function getClass(): string
    {
        return Validator::class;
    }
}
