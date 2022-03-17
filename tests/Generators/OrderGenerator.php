<?php

namespace Tests\Generators;

use App\Models\Order;
use App\Models\Vine;

class OrderGenerator
{
    public static function create(int $cnt = 1, array $data = [])
    {
        $order = Order::create($data);

        return Order::find($order->id);
    }

}
