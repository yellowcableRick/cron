<?php

namespace YellowCable\Cron\Exceptions;

use Exception;
use Throwable;

class CronNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("cron not found. " . $message, $code, $previous);
    }
}
