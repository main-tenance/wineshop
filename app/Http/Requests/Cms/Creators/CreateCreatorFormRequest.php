<?php

namespace App\Http\Requests\Cms\Creators;

use App\Http\Requests\FormRequest;

class CreateCreatorFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
//                'min:3',
            ],
            'original' => [
                'required',
                'min:3',
            ],
        ];
    }
}
