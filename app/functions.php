<?php

function generateFiles($receiptData, $directory_name = null) {
    if ($directory_name === null) {
        $directory_name = ($dateHash = (new DateTime())->format("Ymd-H\hi\ms\s"));
    }
    mkdir(
        $fullPathDirectory = DIRECTORY_SEPARATOR . 'output' . DIRECTORY_SEPARATOR . $directory_name
    );
    
    try {
        file_put_contents(
            $fullPathDirectory . DIRECTORY_SEPARATOR . "docker-compose.yml",
            $receiptData["docker-compose.yml"]
        );
    
        print(sprintf("File %s created in %s\n", "docker-compose.yml", $dateHash));

        if ($receiptData["DockerFile"]) {
            file_put_contents(
                $fullPathDirectory . DIRECTORY_SEPARATOR . "Dockerfile",
                $receiptData["DockerFile"]
            );
        }
    
        print(sprintf("File %s created in %s\n", "Dockerfile", $dateHash));
    } catch (Exception $e) {
        print($e->getMessage() . "\n");
    }
}

function explain($receipt) {
    print("----\n");
    print($receipt->explain() . "\n");
    print("----\n");
}

function isMultiParameter($answer, $parameters): array
{
    $useReceiptCandidate = substr($answer, 0, 11);
    if ($useReceiptCandidate === "use receipt") {
        $configurationParameter = substr($answer, 12);
        $answer = "selected-receipt";

        return [$configurationParameter, $answer];
    }
    
    $multiPartAnswer = explode(":", $answer);
    if (in_array($multiPartAnswer[0], $parameters)) {
        $configurationParameter = $answer; 
        $answer = "configure";

        return [$configurationParameter, $answer];
    }
    return ["", $answer];
}
