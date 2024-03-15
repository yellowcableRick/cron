<?php

namespace YellowCable\Cron\Entry\Field\Command;

use YellowCable\Cron\Entry\Field\Attributes\PregMatch;
use YellowCable\Cron\Entry\Field\Field;

#[PregMatch("/[\x20-\x7e]/")]
class Redirection extends Field
{
    /** @var string $strategy */
    private string $strategy;
    private bool $redirectErrToStdOut = false;

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param "append"|"overwrite"|">"|">>" $strategy
     * @return $this
     */
    public function setStrategy(string $strategy): self
    {
        $this->strategy = match ($strategy) {
            ">", "overwrite" => ">",
            ">>", "append" => ">>"
        };
        return $this;
    }

    public function setRedirectErrToStdOut(bool $redirectErr): self
    {
        $this->redirectErrToStdOut = $redirectErr;
        return $this;
    }

    public function __toString(): string
    {
        $output = $this->getStrategy() . " " . parent::__toString();
        !$this->redirectErrToStdOut ?: $output .= " 2>&1";
        return $output;
    }
}
