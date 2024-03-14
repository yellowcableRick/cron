<?php

namespace YellowCable\Cron\Entry\Host;

abstract class Host implements HostInterface
{
    public function __construct(private readonly string $hostname)
    {
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }
}
