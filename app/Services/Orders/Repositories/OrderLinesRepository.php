<?php

namespace App\Services\Orders\Repositories;

use App\Models\OrderLine;

class OrderLinesRepository
{
    public function create(array $data): OrderLine
    {
        $line = OrderLine::create($data);

        return OrderLine::find($line->id);
    }

    public function update(OrderLine $line, array $data): OrderLine
    {
        $line->update($data);

        return OrderLine::find($line->id);
    }
}
