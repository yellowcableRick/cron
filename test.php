<?php

use YellowCable\Cron\Line\Field\Time\Minute;

require_once("vendor/autoload.php");

var_dump(new Minute("05-10"));
var_dump(new Minute("33"));
var_dump(new Minute("33,44,55"));
var_dump(new Minute("*/5"));

foreach (
    [
    "bliepblaat",
        "55/5",
        "55/5",
        "00-99",
        "91",
        "13,",
        "22,22,,",
    ] as $x
) {
    try {
        $y = new Minute($x);
        var_dump($y);
    } catch (Throwable $t) {
        echo "failed $x correctly!\n";
    }
}
