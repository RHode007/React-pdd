<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
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
        //return parent::toArray($request);
    }
}
