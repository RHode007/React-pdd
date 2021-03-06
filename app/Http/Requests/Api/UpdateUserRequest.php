<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @property string name
 * @property string email
 * @property string password
 */
class UpdateUserRequest extends FormRequest
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
            'name'       => 'string|min:3|max:255',
            'email'      => 'string|email|max:255|unique:users',
            'password'   =>  Password::defaults(),
            'device_name'=> 'max:255'
        ];
    }
}
