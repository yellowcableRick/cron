<?php

namespace YellowCable\Cron\Line\Field\Attributes;

use Attribute;
use YellowCable\Cron\Exceptions\InputNotValidException;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class PregMatch extends Validator
{
    private string $value;
    private false|int $result;
    /** @var array<int, string>  */
    private array $matches;
    public function __construct(public readonly string $regex)
    {
    }

    /**
     * @throws InputNotValidException
     */
    public function validate(string $value): void
    {
        $this->value = $value;
        $this->result = preg_match($this->regex, $value, $matches);
        $this->matches = $matches;
        $this->result && count($this->matches) ?: throw new InputNotValidException(regex: $this->regex, value: $value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getResult(): bool|int
    {
        return $this->result;
    }

    /**
     * @return array<int, string>
     */
    public function getMatches(): array
    {
        return $this->matches;
    }
}
