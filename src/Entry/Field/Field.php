<?php

namespace YellowCable\Cron\Entry\Field;

use Exception;
use ReflectionAttribute;
use ReflectionClass;
use Throwable;
use YellowCable\Cron\Exceptions\InputNotValidException;
use YellowCable\Cron\Exceptions\ValidatorNotFoundException;
use YellowCable\Cron\Entry\Field\Attributes\PregMatch;
use YellowCable\Cron\Entry\Field\Attributes\Validator;
use YellowCable\Cron\Entry\Field\Attributes\Validators;

abstract class Field
{
    protected string $value;

    /**
     * @throws ValidatorNotFoundException
     * @throws InputNotValidException
     * @throws Exception
     */
    public function __construct(string $value)
    {
        try {
            /** @var Validator $validator */
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
        } catch (ValidatorNotFoundException) {
            $this->value = $value;
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
                    fn(ReflectionAttribute $x) => $x->newInstance(),
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
