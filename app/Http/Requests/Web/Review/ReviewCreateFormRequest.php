<?php

namespace App\Http\Requests\Web\Review;

use App\Http\Requests\FormRequest;

class ReviewCreateFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'rating' => [
                'required',
            ],
        ];
    }

    public function getFormData(): array
    {
        $data = parent::getFormData();
        $data['to_publish'] = (int)isset($data['to_publish']);

        return $data;
    }
}
