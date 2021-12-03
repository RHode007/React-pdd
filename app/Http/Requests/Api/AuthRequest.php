<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

/**
 * @property string login
 * @property string password
 * @property string device_name
 */
class AuthRequest extends FormRequest
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
            'login'       => 'string', 'min:3', 'max:255',
            'password'    =>  Rules\Password::defaults(),'confirmed',
            'device_name' => 'string', 'min:3', 'max:255',
        ];
    }
}
