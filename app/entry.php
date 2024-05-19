<?php

declare(strict_types=1);

require "vendor/autoload.php";
require "functions.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\Receipt;

$receipt = new Receipt();

print($receipt->explain() . "\n");
while (true) {
    $okAnswer = readline("It is ok? Type \"yes\" if so. Type \"show options\" to see further configuration: \n");
    switch ($okAnswer) {
        case "yes":
            generateFiles($receipt->get());
            break 2;
        case "show options":
            foreach ($receipt->getParameters() as $parameter) {
                print("* " . $parameter . "\n");
            }
            print("* exit\n");
            break 1;
        case "exit":
            break 2;
        case "":
            if ("yes" === readline("Are you sure to exit?:\n ")) {
                break 2;
            }
            break 1;
        default:
            break 1;
    }
}


