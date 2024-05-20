<?php

declare(strict_types=1);

require "vendor/autoload.php";
require "functions.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\DebianReceipt;
use Danilocgsilva\ConfigurationSpitter\Receipt\MariadbReceipt;

$receipt = new DebianReceipt();
$parameters = $receipt->getParameters();

print($receipt->explain() . "\n");
while (true) {
    $answer = readline("It is ok? Type \"yes\" if so. Type \"change\" if you want to change to another thing. Type \"show options\" to see further configuration. Type an option name to custom the receipt: \n");

    if (in_array($answer, $parameters)) {
        $configurationParameter = $answer;
        $answer = "configure";
    }
    
    switch ($answer) {
        case "configure":
            $receipt->setProperty($configurationParameter);
            explain($receipt);
            break 1;
        case "change":
            print("Let's change!\n");
            $receipt = new MariadbReceipt();
            explain($receipt);
            break 1;
        case "yes":
            generateFiles($receipt->get());
            break 2;
        case "show options":
            foreach ($parameters as $parameter) {
                print("* " . $parameter . "\n");
            }
            print("* exit\n");
            break 1;
        case "exit":
            break 2;
        case "":
            $answer = readline("Are you sure to exit?:\n ");
            if ("yes" === $answer || "exit" === $answer) {
                break 2;
            }
            break 1;
        default:
            break 1;
    }
}


