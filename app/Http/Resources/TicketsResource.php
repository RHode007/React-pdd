<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketsResource extends JsonResource
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
            'Text'       => $this->Text,
            'Status'    => (int) $this->Status,
            'Attachments'     => $this->Attachments
        ];
    }
}
