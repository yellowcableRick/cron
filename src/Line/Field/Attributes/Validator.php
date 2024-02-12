<?php

namespace YellowCable\Cron\Line\Field\Attributes;

use Attribute;
use YellowCable\Cron\Exceptions\InputNotValidException;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
abstract class Validator
{
    /**
     * @param string $value
     * @return void
     * @throws InputNotValidException
     */
    abstract public function validate(string $value): void;
}
