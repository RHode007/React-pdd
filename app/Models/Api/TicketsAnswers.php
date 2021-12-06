<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $ticked_id
 * @property string $text
 * @property int    $is_true
 * @property string $attachments
 */
class TicketsAnswers extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticked_id',
        'text',
        'is_true',
        'attachments'
    ];
}
