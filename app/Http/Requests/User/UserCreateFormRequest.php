<?php


namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rules;

class UserCreateFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'email' => 'string|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
