<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderLinesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request)
    {
        return $this->collection->map(fn($item) => $item->only([
            'offer_id',
            'quantity',
            'price',
        ]));
    }
}
