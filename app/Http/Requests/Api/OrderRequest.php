<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\FormRequest;

class OrderRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'lines' => [
                'offer_id' => [
                    'required',
                ],
                'quantity' => [
                    'required',
                ],
            ]
        ];
    }
}
