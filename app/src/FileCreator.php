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
        $pathParts = explode(DIRECTORY_SEPARATOR, $filePath);
        if (count($pathParts) > 1) {
            mkdir($pathParts[0]);
        }
    }
}
