<?php

namespace Danilocgsilva\ConfigurationSpitterFront;

class FileCreator
{
    public function create(string $filePath, string $fileContent)
    {
        $this->createFolderIfRequired($filePath);
        file_put_contents($filePath, $fileContent);
    }

    private function createFolderIfRequired(string $filePath)
    {
        $pathInfo = pathinfo($filePath);
        $onlyPath = $pathInfo["dirname"];
        if (!is_dir($onlyPath)) {
            mkdir($onlyPath);
        }
    }
}
