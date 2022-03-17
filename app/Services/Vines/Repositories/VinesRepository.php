<?php

namespace App\Services\Vines\Repositories;

use App\Models\Vine;
use Illuminate\Support\Collection;

class VinesRepository
{
    public function getAll(): Collection
    {
        return Vine::all();
    }

    public function create(array $data): Vine
    {
        return Vine::create($data);
    }

    public function update(Vine $vine, array $data): Vine
    {
        $vine->update($data);

        return $vine;
    }

    public function delete(Vine $vine): void
    {
        $vine->delete();
    }

}
