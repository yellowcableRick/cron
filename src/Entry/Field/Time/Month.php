<?php

namespace YellowCable\Cron\Entry\Field\Time;

use YellowCable\Cron\Entry\Field\Attributes\PregMatch;
use YellowCable\Cron\Exceptions\InputNotValidException;

#[PregMatch("/^(([1-9]|1[0-2]),)*([1-9]|1[0-2])$/")] // Between 0 and 23, allows comma separated list
#[PregMatch(
    "/^((JAN|FEB|MAR|APR|MAY|JUN|JUL|AUG|SEP|OCT|NOV|DEC),)*(JAN|FEB|MAR|APR|MAY|JUN|JUL|AUG|SEP|OCT|NOV|DEC)$/"
)]
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^(([1-9]|1[0-2])-([1-9]|1[0-2]))$/")] // Range, where x and y are both between 0 and 23.
class Month extends Time
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        try {
            (new PregMatch("/^[A-Z]{3}$/"))->validate($value);
            $this->transformToNumber($value);
        } catch (InputNotValidException) {
            // Do nothing; this is only required to reform.
        }
    }

    /**
     * @param string $value
     * @return void
     * @throws InputNotValidException
     */
    private function transformToNumber(string $value): void
    {
        $this->value = match ($value) {
            "JAN" => "1",
            "FEB" => "2",
            "MAR" => "3",
            "APR" => "4",
            "MAY" => "5",
            "JUN" => "6",
            "JUL" => "7",
            "AUG" => "8",
            "SEP" => "9",
            "OCT" => "10",
            "NOV" => "11",
            "DEC" => "12",
            default => throw new InputNotValidException("$value is not valid.")
        };
    }
}
