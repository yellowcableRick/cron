<?php

namespace YellowCable\Cron\Entry\Field\Time;

use YellowCable\Cron\Entry\Field\Attributes\PregMatch;

#[PregMatch("/^((2[0-3]|[0-1]?[0-9]),)*(2[0-3]|[0-1]?[0-9])$/")] // Between 0 and 23, allows comma separated list
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^((2[0-3]|[0-1]?[0-9])-(2[0-3]|[0-1]?[0-9]))$/")] // Range, where x and y are both between 0 and 23.
class Hour extends Time
{
}
