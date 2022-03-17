<?php


namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;

class UserUpdateFormRequest extends FormRequest
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
            'login' => [
                'required',
                'min:3',
            ],
            'email' => [
                'required',
                'min:3',
                'email',
            ],
        ];
    }
}
