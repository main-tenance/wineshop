<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\Orders\Handlers\OrderCreateHandler;
use App\Services\Orders\Handlers\OrderUpdateHandler;
use App\Services\Orders\Repositories\OrdersRepository;
use Illuminate\Support\Collection;

class OrdersService
{
    private OrdersRepository $ordersRepository;
    private OrderCreateHandler $orderCreateHandler;
    private OrderUpdateHandler $orderUpdateHandler;

    public function __construct(
        OrdersRepository   $ordersRepository,
        OrderCreateHandler $orderCreateHandler,
        OrderUpdateHandler $orderUpdateHandler
    )
    {
        $this->ordersRepository = $ordersRepository;
        $this->orderCreateHandler = $orderCreateHandler;
        $this->orderUpdateHandler = $orderUpdateHandler;
    }

    public function getAllByCleintId(string $clientId): Collection
    {
        return $this->ordersRepository->getAllByCleintId($clientId);
    }

    public function store(array $data): Order
    {
        return $this->orderCreateHandler->handle($data);
    }

    public function update(Order $order, array $data): Order
    {
        return $this->orderUpdateHandler->handle($order, $data);
    }

    public function delete(Order $order): void
    {
        $this->ordersRepository->delete($order);
    }
}
