<?php

namespace YellowCable\Cron\Line\Field\Time;

use YellowCable\Cron\Line\Field\Attributes\PregMatch;

#[PregMatch("/^(([1-9]|1[0-2]),)*([1-9]|1[0-2])$/")] // Between 0 and 23, allows comma separated list
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^(([1-9]|1[0-2])-([1-9]|1[0-2]))$/")] // Range, where x and y are both between 0 and 23.
class Month extends Time
{
}
