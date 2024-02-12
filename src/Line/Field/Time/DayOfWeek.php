<?php

namespace YellowCable\Cron\Line\Field\Time;

use YellowCable\Cron\Line\Field\Attributes\PregMatch;

#[PregMatch("/^(([0-6]),)*([0-6])$/")] // Between 0 and 23, allows comma separated list
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^(([0-6])-([0-6]))$/")] // Range, where x and y are both between 0 and 23.
class DayOfWeek extends Time
{
}
