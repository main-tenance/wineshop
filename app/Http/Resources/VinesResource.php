<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VinesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'items' => $this->collection->map(fn($item) => $item->only([
                'id',
                'name',
                'code',
                'description',
            ])),
            'count' => $this->count(),
        ];
    }
}
