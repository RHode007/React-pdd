<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'email_verified_at'    => $this->when(Auth::user()->isAdminOrCreator($this->id),$this->email_verified_at),
            'password'   => $this->when(Auth::user()->isAdminOrCreator($this->id),$this->password),
            'status'     => $this->status,
            'api_token'  => $this->when(Auth::user()->isAdminOrCreator($this->id),$this->api_token),
            'reset_key'  => $this->when(Auth::user()->isAdminOrCreator($this->id),$this->reset_key),
            'remember_token'       => $this->when(Auth::user()->isAdminOrCreator($this->id),$this->remember_token)
        ];
    }
}
