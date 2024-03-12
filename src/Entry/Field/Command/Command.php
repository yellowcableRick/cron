<?php

namespace YellowCable\Cron\Entry\Field\Command;

use YellowCable\Cron\Entry\Field\Attributes\PregMatch;
use YellowCable\Cron\Entry\Field\Field;

#[PregMatch("/[\x20-\x7e]/")]
class Command extends Field
{
    public function escapePercentage(): self
    {
        $this->value = str_replace("%", "\%", $this->value);
        return $this;
    }
}
