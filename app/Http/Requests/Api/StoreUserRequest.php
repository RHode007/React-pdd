<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @property string name
 * @property string email
 * @property string password
 * @property string device_name
 */
class StoreUserRequest extends FormRequest
{
    /**
     * @var mixed
     */


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
            'name'       => 'required|string|min:1|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => ['required', Password::defaults()],
            'device_name'=> 'required|max:255'
        ];
    }
}
