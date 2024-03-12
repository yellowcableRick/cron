<?php

namespace YellowCable\Cron\Entry\Field\Time;

use YellowCable\Cron\Entry\Field\Attributes\PregMatch;

#[PregMatch("/^(([0-5]?[0-9]),)*([0-5]?[0-9])$/")]          // Between 00 and 59, allows comma separated list
#[PregMatch("/^(\*)((\/)(30|20|15|12|10|6|5|4|3|2))?$/")]   // Star notation, every x time
#[PregMatch("/^([0-5]?[0-9]-[0-5]?[0-9])$/")]               // Range, where x and y are both between 00 and 59.
class Minute extends Time
{
}
