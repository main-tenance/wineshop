<?php

namespace App\Services\Orders\Handlers;

use App\Models\Order;
use App\Services\Offers\OffersService;
use App\Services\Orders\Repositories\OrderLinesRepository;

class OrderUpdateHandler
{
    private OrderLinesRepository $orderLinesRepository;
    private OffersService $offersService;

    public function __construct(
        OrderLinesRepository $orderLinesRepository,
        OffersService        $offersService
    )
    {
        $this->orderLinesRepository = $orderLinesRepository;
        $this->offersService = $offersService;
    }

    public function handle(Order $order, array $data): Order
    {
        $lines = array_column($data['lines'], null, 'offer_id');
        foreach ($order->lines as $line) {
            if (isset($lines[$line->offer_id])) {
                $this->orderLinesRepository->update($line, $lines[$line->offer_id]);
                unset($lines[$line->offer_id]);
            }
        }
        if (!empty($lines)) {
            foreach ($lines as $line) {
                $line['order_id'] = $order->id;
                $line['price'] = $this->offersService->getById($line['offer_id'])->price;
                $this->orderLinesRepository->create($line);
            }
        }

        return $order->load('lines');
    }
}
