<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int    $id
 * @property int    $ticked_id
 * @property string $text
 * @property int    $is_true
 * @property string $attachments
 */
class TicketsAnswers extends JsonResource
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
            'ticked_id'  => $this->ticked_id,
            'text'       => $this->text,
            'status'     => $this->is_true,
            'attachments'=> $this->attachments
        ];
    }
}
