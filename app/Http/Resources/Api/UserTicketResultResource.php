<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int    $id
 * @property int    $user_id
 * @property int    $ticket_id
 * @property int    $answer_id
 */
class UserTicketResultResource extends JsonResource
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
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'ticket_id' => $this->ticket_id,
            'answer_id' => $this->answer_id

        ];
    }
}
