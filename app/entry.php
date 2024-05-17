<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\Receipt;

$receiptData = (new Receipt())->get();

var_dump($receiptData);
