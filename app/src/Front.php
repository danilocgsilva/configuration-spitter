<?php

namespace Danilocgsilva\ConfigurationSpitterFront;

use Danilocgsilva\ConfigurationSpitter\Receipt\ReceiptInterface;

class Front
{
    private ReceiptInterface $receipt;

    private string|null $folderName = null;

    public function setReceipt(ReceiptInterface $receipt): self
    {
        $this->receipt = $receipt;
        return $this;
    }

    public function setFolderName(string $folder): self
    {
        $this->folderName = $folder;
        return $this;
    }

    public function explain(): void
    {
        if ($this->folderName) {
            $stringExtra = "The folder name will be " . $this->folderName . "\n";
            print($stringExtra . $this->receipt->explain());
        }
        print($this->receipt->explain());
    }
}
