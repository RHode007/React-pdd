<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'Text',
        'Status',
        'Attachments'
    ];

    public function ticketAnswers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketAnswer::class, 'idTicket', 'id');
    }

}
