<?php

namespace YellowCable\Cron\Entry\Field\Attributes;

use Attribute;
use YellowCable\Cron\Exceptions\InputNotValidException;

abstract class Validator
{
    /**
     * @param string $value
     * @return void
     * @throws InputNotValidException
     */
    abstract public function validate(string $value): void;
}
