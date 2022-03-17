<?php

namespace App\Services\Orders\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;


class OrdersRepository
{
    public function getAllByCleintId(string $clientId): Collection
    {
        return Order::where('client_id', $clientId)->get();
    }

    public function create(array $data): Order
    {
        $order = Order::create($data);

        return Order::find($order->id);
    }

    public function update(Order $order, array $data): Order
    {
        $order->update($data);

        return Order::find($order->id);
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }
}
