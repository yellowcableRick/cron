<?php

namespace YellowCable\Cron\Line\Field\Command;

use YellowCable\Cron\Line\Field\Attributes\PregMatch;
use YellowCable\Cron\Line\Field\Field;

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
     * @param string $strategy
     * @return $this
     */
    public function setStrategy(string $strategy): self
    {
        $this->strategy = match ($strategy) {
            ">", "overwrite" => ">",
            ">>", "append" => ">>",
            default => ""
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