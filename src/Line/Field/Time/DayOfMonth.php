<?php

namespace YellowCable\Cron\Line\Field\Time;

use YellowCable\Cron\Line\Field\Attributes\PregMatch;

#[PregMatch("/^((0?[1-9]|[12][0-9]|3[01]),)*(0?[1-9]|[12][0-9]|3[01])$/")] // Between 1 and 31, allows comma separated list
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^((0?[1-9]|[12][0-9]|3[01])-(0?[1-9]|[12][0-9]|3[01]))$/")] // Range, where x and y are both between 1 and 31.
class DayOfMonth extends Time
{
}
