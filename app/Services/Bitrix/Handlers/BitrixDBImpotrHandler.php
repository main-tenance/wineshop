<?php

namespace App\Services\Bitrix\Handlers;

use App\Services\Bitrix\Exceptions\BitrixDBImpotrException;
use Illuminate\Support\Facades\DB;

class BitrixDBImpotrHandler
{
    private string $path;

    public function __construct()
    {
        $this->path = database_path(config('database.import_path'));
    }

    public function handle(string $file): void
    {
        if (!file_exists($this->path . $file)) {
            throw new BitrixDBImpotrException(" File $file does not exists.");
        }

        $sql = file_get_contents($this->path . $file);
        if (empty($sql)) {
            throw new BitrixDBImpotrException(" File $file is empty.");
        }

        try {
            DB::unprepared($sql);
        } catch (\Illuminate\Database\QueryException $ex) {
            throw new BitrixDBImpotrException(" File $file import error, code = " . $ex->getCode());
        } catch (\Exception $e) {
            throw new BitrixDBImpotrException(" File $file import error.");
        }
    }

    public function getFiles(array $tables): array
    {
        $files = !empty($tables) ? $this->getTablesFiles($tables) : $this->getAllFiles();

        return $files;
    }

    private function getAllFiles(): array
    {
        $files = [];
        foreach (scandir($this->path) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $files[] = $file;
        }

        return $files;
    }

    private function getTablesFiles(array $tables): array
    {
        array_walk($tables, fn(&$item) => $item = "$item.sql");

        return $tables;
    }


}
