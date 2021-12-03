<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'email_verified_at'    => $this->email_verified_at,
            'password'   => $this->password,
            'status'     => $this->status,
            'api_key'    => $this->api_key,
            'reset_key'  => $this->reset_key,
            'remember_token'       => $this->remember_token

        ];
    }
}
