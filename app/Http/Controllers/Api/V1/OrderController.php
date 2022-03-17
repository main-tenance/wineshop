<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Services\Orders\Exceptions\OrderClientMismatchException;
use App\Services\Orders\OrdersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private string $clientId;

    public function __construct(Request $request)
    {
        $this->clientId = $this->getClient($request);
    }

    public function getOrdersService(): OrdersService
    {
        return app(OrdersService::class);
    }

    public function getClient(Request $request): string
    {
        $bearerToken = base64_decode($request->bearerToken());
        $res = preg_match('~\"aud\":\"([^\"]+)\"~', $bearerToken, $matches);
        if (!$res || !isset($matches[1])) {
            throw new \Exception('Client not found');
        }

        return $matches[1];
    }

    /**
     * Display a listing of the resource.
     *
     * @return OrdersResource
     */
    public function index(Request $request): OrdersResource
    {
        $orders = $this->getOrdersService()->getAllByCleintId($this->clientId);

        return new OrdersResource($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return OrderResource
     */
    public function store(OrderRequest $request): OrderResource
    {
        $data = $request->getFormData();
        $data['client_id'] = $this->clientId;
        $order = $this->getOrdersService()->store($data);

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        if ($order->client_id != $this->clientId) {
            throw new OrderClientMismatchException('Client mismatch');
        }

        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return OrderResource
     */
    public function update(OrderRequest $request, Order $order): OrderResource
    {
        if ($order->client_id != $this->clientId) {
            throw new OrderClientMismatchException('Client mismatch');
        }

        $data = $request->getFormData();
        $order = $this->getOrdersService()->update($order, $data);

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        if ($order->client_id != $this->clientId) {
            throw new OrderClientMismatchException('Client mismatch');
        }

        $this->getOrdersService()->delete($order);

        return response()->json(['status' => 'ok']);
    }

}
