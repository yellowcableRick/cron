<?php

namespace YellowCable\Cron\Exceptions;

use Exception;
use Throwable;

class HostNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("Host object not found. " . $message, $code, $previous);
    }
}
