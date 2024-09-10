<?php

require "vendor/autoload.php";

use Danilocgsilva\ConfigurationSpitterFront\FileCreator;

function generateFiles($receiptData, $directory_name = null)
{
    if ($directory_name === null) {
        $directory_name = (new DateTime())->format("Ymd-H\hi\ms\s");
    }
    mkdir(
        $fullPathDirectory = DIRECTORY_SEPARATOR . 'output' . DIRECTORY_SEPARATOR . $directory_name
    );

    $fileCreator = new FileCreator();
    try {
        foreach ($receiptData as $filePath => $fileFromReceiptContent) {
            print ("File to be created: " . $filePath . "\n");
            $fileCreator->create($fullPathDirectory . DIRECTORY_SEPARATOR . $filePath, $fileFromReceiptContent);
        }
    } catch (Exception $e) {
        print ($e->getMessage() . "\n");
    }
}

function explain($receipt)
{
    print ("----\n");
    print ($receipt->explain() . "\n");
    print ("----\n");
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
