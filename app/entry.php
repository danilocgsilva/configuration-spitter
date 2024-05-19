<?php

declare(strict_types=1);

require "vendor/autoload.php";
require "functions.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\Receipt;

$receipt = new Receipt();

print($receipt->explain() . "\n");
$okAnswer = readline("It is ok? \n");

switch ($okAnswer) {
    case "yes":
        generateFiles($receipt->get());
        break;
    default:
        print("Aborted.\n");
}


