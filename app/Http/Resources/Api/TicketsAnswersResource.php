<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int    $id
 * @property int    $ticket_id
 * @property string $text
 * @property int    $is_true
 * @property string $attachments
 */
class TicketsAnswersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        //TODO test return parent::toArray($request);
        return [
            'id'         => $this->id,
            'ticket_id'  => $this->ticket_id,
            'text'       => $this->text,
            'is_true'     => $this->is_true,
            'attachments'=> $this->attachments
        ];
    }
}
