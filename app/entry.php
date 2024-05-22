<?php

declare(strict_types=1);

require "vendor/autoload.php";
require "functions.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\DebianReceipt;
use Danilocgsilva\ConfigurationSpitter\Receipt\MariadbReceipt;
use Danilocgsilva\ConfigurationSpitter\Receipt\MysqlReceipt;

$receiptsList = [
    DebianReceipt::class,
    MariadbReceipt::class,
    MysqlReceipt::class,
];

$receipt = new DebianReceipt();
$parameters = $receipt->getParameters();

print($receipt->explain() . "\n");
while (true) {
    print("It is ok?\n");
    print("-> Type \"yes\" if so.\n");
    print("-> Type \"change\" if you want to change to another thing.\n");
    print("-> Type \"show options\" to see further configuration.\n");
    print("-> Type an option name to custom the receipt.\n");
    print("-> Type \"show receipts\" to see further receipts: \n");
    print("-> Type \"use receipt YOUR_RECEIPT\" to change to a specific receipt: \n");
    $answer = readline();

    $multiParameterResult = isMultiParameter($answer, $parameters);
    $configurationParameter = $multiParameterResult[0];
    $answer = $multiParameterResult[1];
    
    switch ($answer) {
        case "configure":
            $receipt->setProperty($configurationParameter);
            explain($receipt);
            break 1;
        case "change":
            print("Let's change!\n");
            $receipt = new MariadbReceipt();
            explain($receipt);
            $parameters = $receipt->getParameters();
            break 1;
        case "yes":
            generateFiles($receipt->get());
            break 2;
        case "change service name":
            break 2;
        case "show options":
            foreach ($parameters as $parameter) {
                print("* " . $parameter . "\n");
            }
            print("* change service name\n");
            print("* exit\n");
            break 1;
        case "show receipts":
            print("Choose the receipt base:\n");
            foreach ($receiptsList as $receipt) {
                print("* " . $receipt::getName() . "\n");
            }
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


