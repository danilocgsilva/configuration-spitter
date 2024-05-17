<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Danilocgsilva\ConfigurationSpitter\Receipt\Receipt;

$receiptData = (new Receipt())->get();

$dockerCompose = $receiptData["docker-compose.yml"];
$dockerFile = $receiptData["DockerFile"];

$fullPathDirectory = DIRECTORY_SEPARATOR . 'output' . DIRECTORY_SEPARATOR . ($dateHash = (new DateTime())->format("Ymd-H\hi\ms\s"));

mkdir($fullPathDirectory);

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

