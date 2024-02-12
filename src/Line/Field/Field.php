<?php

namespace YellowCable\Cron\Line\Field;

use Exception;
use ReflectionAttribute;
use ReflectionClass;
use Throwable;
use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Line\Field\Attributes\PregMatch;
use YellowCable\Cron\Line\Field\Attributes\Validator;
use YellowCable\Cron\Line\Field\Attributes\Validators;

abstract class Field
{
    private string $value;

    /**
     * @throws ValidatorNotFoundException
     * @throws InputNotValidException
     * @throws Exception
     */
    public function __construct(string $value)
    {
        foreach ($this->getValidators() as $validator) {
            try {
                $validator->validate($value);
                $this->value = $value;
                return;
            } catch (InputNotValidException $throwable) {
                !isset($exception) ?: $throwable->setPrevious($exception);
                $exception = new InputNotValidException(previous: $throwable);
            }
        }
        throw $exception ?? throw new Exception("Something went wrong with the constructor of: " . get_called_class());
    }

    /**
     * @throws ValidatorNotFoundException
     */
    public function getValidators(): Validators
    {
        try {
            return new Validators(
                array_map(
                    fn($x) => $x->newInstance(),
                    (new ReflectionClass($this))
                        ->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF)
                )
            );
        } catch (Throwable $throwable) {
            throw new ValidatorNotFoundException(previous: $throwable);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
