<?php

namespace YellowCable\Cron\Line\Field\Command;

use YellowCable\Cron\Line\Field\Attributes\PregMatch;
use YellowCable\Cron\Line\Field\Field;

#[PregMatch("/[\x20-\x7e]/")]
class Command extends Field
{
}
