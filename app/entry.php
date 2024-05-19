<?php

declare(strict_types=1);

require "vendor/autoload.php";
require "functions.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\Receipt;

$receipt = new Receipt();

print($receipt->explain() . "\n");
$okAnswer = readline("It is ok? Type \"yes\" if so. Type \"show options\" to see further configuration. \n");

switch ($okAnswer) {
    case "yes":
        generateFiles($receipt->get());
        break;
    case "show options":
        foreach ($receipt->getParameters() as $parameter) {
            print("* " . $parameter . "\n");
        }
        break;
    default:
        print("Aborted.\n");
}


