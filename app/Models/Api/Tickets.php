<?php

namespace App\Models\Api;

use App\Models\TicketAnswer;
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
        return $this->hasMany(TicketsAnswers::class, 'ticket_id', 'id');
    }

}
