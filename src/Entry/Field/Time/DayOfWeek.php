<?php

namespace YellowCable\Cron\Entry\Field\Time;

use YellowCable\Cron\Entry\Field\Attributes\PregMatch;
use YellowCable\Cron\Exceptions\InputNotValidException;

#[PregMatch("/^(([0-6]),)*([0-6])$/")] // Between 0 and 23, allows comma separated list
#[PregMatch(
    "/^((SUN|MON|TUE|WED|THU|FRI|SAT),)*(SUN|MON|TUE|WED|THU|FRI|SAT)$/"
)]
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^(([0-6])-([0-6]))$/")] // Range, where x and y are both between 0 and 23.
class DayOfWeek extends Time
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
            "SUN" => "0",
            "MON" => "1",
            "TUE" => "2",
            "WED" => "3",
            "THU" => "4",
            "FRI" => "5",
            "SAT" => "6",
            default => throw new InputNotValidException("$value is not valid.")
        };
    }
}
