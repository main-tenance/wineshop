<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\FormRequest;

class VineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
            ],
            'code' => [
                'required',
                'min:3',
            ],
        ];
    }
}
