<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $user_id
 * @property int    $ticket_id
 * @property int    $answer_id
 */
class UserTicketResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'answer_id',
    ];
}
