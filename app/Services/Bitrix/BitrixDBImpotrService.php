<?php

namespace App\Services\Bitrix;

use App\Services\Bitrix\Handlers\BitrixDBImpotrHandler;

class BitrixDBImpotrService
{
    private BitrixDBImpotrHandler $importHandler;

    public function __construct(BitrixDBImpotrHandler $importHandler)
    {
        $this->importHandler = $importHandler;
    }

    public function import(string $file): void
    {
        $this->importHandler->handle($file);
    }

    public function getFiles(array $tables = []): array
    {
        return $this->importHandler->getFiles($tables);
    }

}
