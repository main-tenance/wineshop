<?php

namespace Tests\Generators;

use App\Models\Vine;

class VineGenerator
{
    public static function create(int $cnt = 1, array $data = [])
    {
        return Vine::factory($cnt)->create($data);
    }

}
