<?php

namespace YellowCable\Cron\Exceptions;

use Exception;
use ReflectionClass;
use ReflectionException;
use Throwable;

class InputNotValidException extends Exception
{
    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null,
        string $regex = "",
        string $value = ""
    ) {
        parent::__construct(
            "Validation failed, input $value not accepted through $regex. " . $message,
            $code,
            $previous
        );
    }

    /**
     * @throws ReflectionException
     */
    public function setPrevious(self $inputNotValidException): self
    {
        try {
            (new ReflectionClass($this))->getProperty("previous")->setValue($this, $inputNotValidException);
        } catch (ReflectionException) {
            $this->__construct($this->getMessage(), $this->getCode(), $inputNotValidException);
        }
        return $this;
    }
}
