<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request): array
    {
        $data = $this->only([
            'id',
            'name',
            'last_name',
            'login',
            'email',
            'phone',
        ]);
        $data['vip'] = $this->isVip();

        return $data;
    }
}
