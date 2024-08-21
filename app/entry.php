<?php

declare(strict_types=1);

require "vendor/autoload.php";
require "functions.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\{
    DebianReceipt,
    MariadbReceipt,
    MysqlReceipt,
    NodeReceipt
};
use Danilocgsilva\ConfigurationSpitterFront\Front;

$receiptsList = [
    DebianReceipt::class,
    MariadbReceipt::class,
    MysqlReceipt::class,
    NodeReceipt::class
];

$receipt = new DebianReceipt();
$parameters = $receipt->getParameters();
$folder_name = null;
$front = new Front();
$front->setReceipt($receipt);

print($receipt->explain() . "\n");
while (true) {
    print("-> Type \"yes\" if so.\n");
    print("-> Type \"show options\" to see further configuration.\n");
    print("-> Type an option name to custom the receipt.\n");
    print("-> Type \"show receipts\" to see further receipts: \n");
    print("-> Type \"use receipt YOUR_RECEIPT\" to change to a specific receipt: \n");
    print("-> Type \"folder name\" to change the output folder name: \n");
    print("-> Type \"name all\" to change at same time, the service name, container name and folder name: \n");
    $answer = readline();

    $multiParameterResult = isMultiParameter($answer, $parameters);
    $configurationParameter = $multiParameterResult[0];
    $answer = $multiParameterResult[1];
    
    switch ($answer) {
        case "folder name":
            $folder_name = readline("Type the desired folder name: ");
            $front->setFolderName($folder_name);
            print("You setted the output folder name as " . $folder_name . ".\n");
            break 1;
        case "name all":
            $name_for_all = readline("Type the desired name: ");
            $front->setFolderName($name_for_all);
            $receipt->setProperty("service-name:" . $name_for_all);
            $receipt->setProperty("container-name:" . $name_for_all);
            $front->setFolderName($name_for_all);
            break 1;
        case "configure":
            $receipt->setProperty($configurationParameter);
            $front->explain();
            break 1;
        case "selected-receipt":
            print("The choosed receipt is " . $configurationParameter . "\n");
            $receiptName = "\\Danilocgsilva\\ConfigurationSpitter\\Receipt\\" . $configurationParameter . "Receipt";
            $receipt = new $receiptName();
            $parameters = $receipt->getParameters();
            $front->explain();
            break 1;
        case "yes":
            generateFiles($receipt->get(), $folder_name);
            break 2;
        case "show options":
            foreach ($parameters as $parameter) {
                print("* " . $parameter . "\n");
            }
            print("* change service name\n");
            print("* exit\n");
            print($receipt->explain() . "\n");
            print("So, how to proceed?\n");
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
            print("You give a not known answer.\n");
            break 1;
    }
}


