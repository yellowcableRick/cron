<?php

namespace YellowCable\Cron\Entry\Host;

class Localhost extends Host
{
    public function __construct()
    {
        parent::__construct("localhost");
    }
}
