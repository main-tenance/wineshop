<?php


namespace App\Services\Codes\Repositories;

use App\Models\Code;
use Illuminate\Support\Facades\DB;

class CodesRepository
{
    public function create(array $data): Code
    {
        return Code::create($data);
    }

    public function deleteByCode(string $code): void
    {
        DB::table('codes')->where('code', $code)->delete();
    }
}
