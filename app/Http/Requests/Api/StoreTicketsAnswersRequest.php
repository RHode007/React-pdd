<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketsAnswersRequest extends FormRequest
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
            'ticket_id'   => 'required|max:255',
            'text'        => 'required|max:255',
            'is_true'     => 'required|max:255',
            'attachments' => 'max:255',
        ];
    }
}
