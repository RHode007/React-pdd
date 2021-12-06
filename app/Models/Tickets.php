<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $text
 * @property int    $status
 * @property string $attachments
 */
class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'status',
        'attachments'
    ];

    public function ticketAnswers(): HasMany
    {
        return $this->hasMany(TicketAnswer::class, 'ticket_id', 'id');
    }

}
