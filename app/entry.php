<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\Receipt;

function generateFiles($receiptData) {
    mkdir(
        $fullPathDirectory = DIRECTORY_SEPARATOR . 'output' . DIRECTORY_SEPARATOR . ($dateHash = (new DateTime())->format("Ymd-H\hi\ms\s"))
    );
    
    try {
        file_put_contents(
            $fullPathDirectory . DIRECTORY_SEPARATOR . "docker-compose.yml",
            $receiptData["docker-compose.yml"]
        );
    
        print(sprintf("File %s created in %s\n", "docker-compose.yml", $dateHash));
    
        file_put_contents(
            $fullPathDirectory . DIRECTORY_SEPARATOR . "Dockerfile",
            $receiptData["DockerFile"]
        );
    
        print(sprintf("File %s created in %s\n", "Dockerfile", $dateHash));
    } catch (Exception $e) {
        print($e->getMessage() . "\n");
    }
}

$receipt = new Receipt();
print($receipt->explain() . "\n");
$receiptData = $receipt->get();

$okAnswer = readline("It is ok? \n");
if ($okAnswer === "yes") {
    generateFiles($receiptData);
} else {
    print("Aborted.\n");
}



