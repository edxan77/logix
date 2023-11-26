<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_FAILED = 'failed';

    protected $table = 'emails';

    protected $fillable = [
        'from',
        'from_name',
        'to',
        'subject',
        'sent_date',
        'status',
    ];
}
