<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property int    $status
 * @property int    $email_verified_at
 * @property string $password
 * @property string $api_token
 * @property string $reset_key
 * @property int    $remember_token
 *
 */
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
        $result = [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'status'    => $this->status,
        ];
        if(Auth::user()->isAdminOrCreator($this->id)){
            $result['email_verified_at']    = $this->email_verified_at;
            $result['password']             = $this->password;
            $result['api_token']            = $this->api_token;
            $result['reset_key']            = $this->reset_key;
            $result['remember_token']       = $this->remember_token;
        }
        return $result;
    }
}
