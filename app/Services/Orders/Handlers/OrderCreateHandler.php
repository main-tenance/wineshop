<?php

namespace App\Services\Orders\Handlers;

use App\Models\Order;
use App\Services\Offers\OffersService;
use App\Services\Orders\Exceptions\OrderCreateException;
use App\Services\Orders\Repositories\OrderLinesRepository;
use App\Services\Orders\Repositories\OrdersRepository;

class OrderCreateHandler
{
    private OrdersRepository $ordersRepository;
    private OrderLinesRepository $orderLinesRepository;
    private OffersService $offersService;

    public function __construct(
        OrdersRepository     $ordersRepository,
        OrderLinesRepository $orderLinesRepository,
        OffersService        $offersService
    )
    {
        $this->ordersRepository = $ordersRepository;
        $this->orderLinesRepository = $orderLinesRepository;
        $this->offersService = $offersService;
    }

    public function handle(array $data): Order
    {
        $lines = [];
        foreach ($data['lines'] as $line) {
            if ($line['quantity'] <= 0) {
                continue;
            }

            $offer = $this->offersService->getById($line['offer_id']);
            if ($offer->active == 0) {
                continue;
            }

            $line['price'] = $offer->price;
            $lines[] = $line;
        }
        if (empty($lines)) {
            throw new OrderCreateException('No order lines');
        }

        $order = $this->ordersRepository->create($data);
        foreach ($lines as $line) {
            $line['order_id'] = $order->id;
            $this->orderLinesRepository->create($line);
        }

        return $order->load('lines');
    }
}
