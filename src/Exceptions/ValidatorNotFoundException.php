<?php

namespace YellowCable\Cron\Exceptions;

use Exception;
use Throwable;

class ValidatorNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("Validator not found. " . $message, $code, $previous);
    }
}
