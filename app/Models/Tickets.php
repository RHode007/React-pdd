<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'status',
        'attachments'
    ];

    public function ticketAnswers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketAnswer::class, 'ticket_id', 'id');
    }

}
