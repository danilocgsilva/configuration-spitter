<?php

declare(strict_type=1);

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